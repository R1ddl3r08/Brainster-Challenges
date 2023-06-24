<?php

namespace Database;

class Query
{
    protected \PDO $connection;

    public function __construct()
    {
        $this->connection = Database::connect();
    }

    // Global methods
    public function exists($table , $id) : bool
    {
        $sql = "SELECT id FROM {$table} WHERE id = :id;";

        $stmt = $this->connection->prepare($sql);

        $stmt->execute(['id' => $id]);

        return (bool) $stmt->rowCount();
    }

    public function getAll($tableName)
    {
        $sql = "SELECT * FROM $tableName";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function select($tableName, $id)
    {
        $sql = "SELECT * FROM $tableName WHERE id=:id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    // Admin methods
    public function validateAdmin($email, $password)
    {
        $sql = 'SELECT * FROM admins WHERE email=:email';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':email', $email, \PDO::PARAM_STR);
        $stmt->execute();

        $admin = $stmt->fetch(\PDO::FETCH_ASSOC);

        if($admin && password_verify($password, $admin['password'])){
            return true;
        }

        return false;
    }

    //Vehicle model methods
    public function addVehicleModel($vehicleModel)
    {
        $sql = 'INSERT INTO vehicle_models (vehicle_model) VALUES (:vehicleModel);';

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':vehicleModel', $vehicleModel, \PDO::PARAM_STR);
        $stmt->execute();
    }

    public function deleteVehicleModel($id)
    {
        $sql = "DELETE FROM vehicle_models WHERE id=:id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateVehicleModel($vehicleModel, $id)
    {
        $sql = "UPDATE vehicle_models SET vehicle_model = :vehicleModel WHERE id=:id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':vehicleModel', $vehicleModel, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    // Registration methods
    public function formatDate($inputDate)
    {
        $inputDate = explode('/', $inputDate);

        $date = $inputDate[2] . '-' . $inputDate[0] . '-' . $inputDate[1];

        return $date;
    }

    public function isValidDateFormat($inputDate)
    {
        $dateFormat1 = \DateTime::createFromFormat('m/d/Y', $inputDate);
        $dateFormat2 = \DateTime::createFromFormat('Y-m-d', $inputDate);

        if (($dateFormat1 && $dateFormat1->format('m/d/Y') === $inputDate) || ($dateFormat2 && $dateFormat2->format('Y-m-d') === $inputDate)) {
            return true;
        } else {
            return false;
        }
    }
    
    public function chassisExists($vehicleChassisNumber)
    {
        $sql = "SELECT vehicle_chassis_number FROM registrations WHERE vehicle_chassis_number = :vehicleChassisNumber;";

        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':vehicleChassisNumber', $vehicleChassisNumber, \PDO::PARAM_STR);
        $stmt->execute();

        return (bool) $stmt->rowCount();
    }

    public function addRegistration($vehicleModel, $vehicleType, $vehicleChassisNumber, $vehicleProductionYear, $registrationNumber, $fuelType, $registrationTo)
    {
        $sql = "INSERT INTO registrations (vehicle_model, vehicle_type, vehicle_chassis_number, vehicle_production_year, registration_number, fuel_type, registration_to)
                VALUES (:vehicle_model, :vehicle_type, :vehicle_chassis_number, :vehicle_production_year, :registration_number, :fuel_type, :registration_to)";
    
        $data = [
            'vehicle_model' => $vehicleModel,
            'vehicle_type' => $vehicleType,
            'vehicle_chassis_number' => $vehicleChassisNumber,
            'vehicle_production_year' => $vehicleProductionYear,
            'registration_number' => $registrationNumber,
            'fuel_type' => $fuelType,
            'registration_to' => $registrationTo
        ];
    
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    public function getRegistrations()
    {
        $sql = "SELECT r.id, vm.vehicle_model, vt.vehicle_type, r.vehicle_chassis_number, r.vehicle_production_year, r.registration_number, ft.fuel_type, r.registration_to
        FROM registrations r
        JOIN vehicle_models vm ON r.vehicle_model = vm.id
        JOIN vehicle_types vt ON r.vehicle_type = vt.id
        JOIN fuel_types ft ON r.fuel_type = ft.id
        ORDER BY id ASC";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function extendRegistration($registration, $id)
    {
        $registrationTo = new \DateTime($registration['registration_to']);
        
        $newDate = $registrationTo->add(new \DateInterval('P1Y'));
    
        $extendedRegistrationTo = $newDate->format('Y-m-d');
    
        $sql = 'UPDATE registrations SET registration_to = :registration_to WHERE id=:id';
    
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':registration_to', $extendedRegistrationTo, \PDO::PARAM_STR);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
    
        $stmt->execute();
    }

    public function deleteRegistration($id)
    {
        $sql = 'DELETE FROM registrations WHERE id=:id';
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateRegistration($id, $vehicleModel, $vehicleType, $vehicleChassisNumber, $vehicleProductionYear, $registrationNumber, $fuelType, $registrationTo)
    {
        $sql = "UPDATE registrations SET
            vehicle_model = :vehicleModel,
            vehicle_type = :vehicleType,
            vehicle_chassis_number = :vehicleChassisNumber,
            vehicle_production_year = :vehicleProductionYear,
            registration_number = :registrationNumber,
            fuel_type = :fuelType,
            registration_to = :registrationTo
        WHERE id = :id";

        $data = [
            'vehicleModel' => $vehicleModel,
            'vehicleType' => $vehicleType,
            'vehicleChassisNumber' => $vehicleChassisNumber,
            'vehicleProductionYear' => $vehicleProductionYear,
            'registrationNumber' => $registrationNumber,
            'fuelType' => $fuelType,
            'registrationTo' => $registrationTo,
            'id' => $id
        ];

        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
    }

    // Search methods
    public function userSearchRegistration($registration)
    {
        $sql = "SELECT r.id, vm.vehicle_model, vt.vehicle_type, r.vehicle_chassis_number, r.vehicle_production_year, r.registration_number, ft.fuel_type, r.registration_to
        FROM registrations r
        JOIN vehicle_models vm ON r.vehicle_model = vm.id
        JOIN vehicle_types vt ON r.vehicle_type = vt.id
        JOIN fuel_types ft ON r.fuel_type = ft.id
        WHERE r.registration_number LIKE :registration";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':registration', $registration, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC);
    }

    public function adminSearchRegistration($registration)
    {
        $sql = "SELECT r.id, vm.vehicle_model, vt.vehicle_type, r.vehicle_chassis_number, r.vehicle_production_year, r.registration_number, ft.fuel_type, r.registration_to
        FROM registrations r
        JOIN vehicle_models vm ON r.vehicle_model = vm.id
        JOIN vehicle_types vt ON r.vehicle_type = vt.id
        JOIN fuel_types ft ON r.fuel_type = ft.id
        WHERE r.registration_number LIKE :registration OR vm.vehicle_model LIKE :registration OR r.vehicle_chassis_number LIKE :registration
        ORDER BY id";
        $stmt = $this->connection->prepare($sql);
        $stmt->bindParam(':registration', $registration, \PDO::PARAM_STR);
        $stmt->execute();

        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

}


?>