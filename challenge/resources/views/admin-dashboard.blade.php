<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <button id="createUserButton" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create user</button>
                    <table class="table-auto w-full">
                        <thead>
                            <tr>
                                <th class="px-4 py-2">ID</th>
                                <th class="px-4 py-2">Username</th>
                                <th class="px-4 py-2">Email</th>
                                <th class="px-4 py-2">Is Active</th>
                                <th class="px-4 py-2">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div id="userModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
        <div class="modal-overlay absolute inset-0 bg-gray-500 opacity-75"></div>

        <div class="modal-container bg-white w-11/12 md:max-w-md mx-auto rounded shadow-lg z-50 overflow-y-auto">
            <div class="modal-content py-4 text-left px-6">
                <h1 class="text-2xl font-semibold mb-4">Create User</h1>
                
                <form>
                    @csrf
                    <div class="mb-4">
                        <label for="username" class="block text-gray-700 font-bold mb-2">Username</label>
                        <input type="text" id="username" name="username" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" id="email" name="email" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                        <input type="password" id="password" name="password" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="block text-gray-700 font-bold mb-2">Confirm Password</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="w-full px-3 py-2 border rounded-lg">
                    </div>

                    <div class="flex items-center justify-end">
                        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Create</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function () {
            const createButton = $('#createUserButton');
            const modal = $('#userModal');
            const closeModal = $('.modal-overlay');
            const tableBody = $('table tbody')

            createButton.click(function () {
                modal.removeClass('hidden')
            })

            closeModal.click(function () {
                modal.addClass('hidden')
            })

            function getUsers(){
                axios.get('/api/users')
                .then(function (response) {
                    const users = response.data
                    console.log(response)
                    tableBody.empty()

                    $.each(users, function (index, user) {
                        const deactivateButton = user.is_active
                        ? `<button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded deactivateButton" data-id=${user.id}>Deactivate</button>`
                        : '';

                        const row = `
                            <tr>
                                <td class="px-4 py-2 text-center">${user.id}</td>
                                <td class="px-4 py-2 text-center">${user.username}</td>
                                <td class="px-4 py-2 text-center">${user.email}</td>
                                <td class="px-4 py-2 text-center">${user.is_active ? 'Yes' : 'No'}</td>
                                <td class="px-4 py-2 text-left">
                                <button class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded deleteButton" data-id=${user.id}>Delete</button>
                                ${deactivateButton}
                                </td>
                            </tr>
                        `
                        tableBody.append(row)
                    })
                })
                .catch(function (error) {
                    console.error('Error fetching user data:', error)
                })
            }

            getUsers()

            $('form').submit(function (e) {
                e.preventDefault()

                const formData = $('form').serialize()

                axios.post('/api/users', formData)
                .then(function (response) {
                    modal.addClass('hidden')
                    alert(response.data.message)
                    $('form input[type="text"], form input[type="email"], form input[type="password"]').val('');
                    getUsers()
                })
                .catch(function (error) {
                    let errors = error.response.data.errors
                    let errorMessages = []
                    Object.keys(errors).forEach((fieldName) => {
                        errors[fieldName].forEach((errorMessage) => {
                            errorMessages.push(`${fieldName}: ${errorMessage}\n`);
                        });
                    });
                    alert(errorMessages)
                })
            })

            $(document).on('click', '.deleteButton', function () {
                const userId = $(this).data('id')
                axios.delete(`/api/users/${userId}`)
                .then(function (response) {
                    console.log(response)
                    alert(response.data.message)
                    getUsers()
                })
                .catch(function (error) {
                    console.log(error)
                })
            })

            $(document).on('click', '.deactivateButton', function () {
                const userId = $(this).data('id')
                console.log('clicked')

                axios.patch(`/api/users/${userId}`)
                .then(function (response) {
                    alert(response.data.message)
                    getUsers()
                })
                .catch(function (error) {
                    console.log(error)
                })
            })
        })
    </script>

</x-app-layout>