<?php

namespace Database;

class Query
{
    protected \PDO $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    public function store($image_url, $title, $subtitle, $about_you, $tel, $location, $type , $company_description , $linkedin, $facebook, $twitter, $google, $descriptions, $image_urls)
    {
        // Insert into website_info table
        $website_info_sql = "INSERT INTO website_info (image_url, title, subtitle, about_you, tel, location, type, description, linkedin, facebook, twitter, google) VALUES (:image_url, :title, :subtitle, :about_you, :tel, :location, :type, :description, :linkedin, :facebook, :twitter, :google)";
        
        $website_info_data = [
            'image_url' => $image_url,
            'title' => $title,
            'subtitle' => $subtitle,
            'about_you' => $about_you,
            'tel' => $tel,
            'location' => $location,
            'type' => $type,
            'description' => $company_description,
            'linkedin' => $linkedin,
            'facebook' => $facebook,
            'twitter' => $twitter,
            'google' => $google
        ];
        
        $website_info_stmt = $this->connection->prepare($website_info_sql);
        
        $website_info_stmt->execute($website_info_data);
        
        
        // Insert into services_products table with foreign key refering to website_info table
        $website_info_id = $this->connection->lastInsertId();

        $services_products_sql = "INSERT INTO services_products (description, image_url, website_info_id) VALUES (:description, :image_url, :website_info_id)";
        
        $services_products_stmt = $this->connection->prepare($services_products_sql);
        
        $services_products_stmt->bindParam(':website_info_id', $website_info_id);
        
        for ($i = 0; $i < count($descriptions); $i++) {
            $services_products_stmt->bindParam(':description', $descriptions[$i]);
            $services_products_stmt->bindParam(':image_url', $image_urls[$i]);
            $services_products_stmt->execute();
        }

        return $website_info_id;
    }

    public function getWebsiteInfo($id)
    {
        $sql = 'SELECT * FROM website_info WHERE id=:id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function getServicesProducts($websiteInfoId)
    {
        $sql = 'SELECT * FROM services_products WHERE website_info_id=:website_info_id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':website_info_id', $websiteInfoId, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function exists($table, $type)
    {
        $sql = "SELECT id FROM {$table} WHERE type = :type;";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':type', $type, \PDO::PARAM_STR);
        $stmt->execute();

        return (bool) $stmt->rowCount();
    }

}


?>