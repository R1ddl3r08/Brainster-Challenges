$(function(){


    $('.closeModal').on('click', function(){
        $('#requestModal').hide()
    })

    $('.openModal').on('click', function(event){
        event.preventDefault()
        $('#requestModal').show()
    })

    $('.deleteProjectBtn').on('click', function(event){
        event.preventDefault()
        const projectId = $(this).data('project-id')
        $('input[name="projectId"]').val(projectId)
        $('#deleteModal').show()
    })

    $('.cancelDelete').on('click', function(){
        $('#deleteModal').hide()
    })

    $('.editProjectBtn').on('click', handleEditFormDisplay)

    $('.cancelEdit').on('click', handleEditFormDisplay)

    function handleEditFormDisplay(){
        const $innerProject = $(this).closest('.innerProject')
        const $editForm = $innerProject.find('.editForm')
        const $projectContnet = $innerProject.find('.projectContent')
        const $editContainer = $innerProject.find('.editContainer')
        $editForm.toggle()
        $projectContnet.toggle()
        $editContainer.toggle()
    }




})