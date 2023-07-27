$(function(){

    const budgetAmount = $('#budget-amount')
    const expenseAmount = $('#expense-amount')
    const balanceAmount = $('#balance-amount')
    const budgetFeedback = $('.budget-feedback')
    const expenseFeedback = $('.expense-feedback')

    let editedRowIndex = null

    localStorage.setItem("submitted", false)


    // Functions
    function showBalance(){
        balanceAmount.text(budgetAmount.text() - expenseAmount.text())
        
        if(balanceAmount.text() > 0){
            $('.balance').addClass('showGreen')
            $('.balance').removeClass('showRed')
            $('.balance').removeClass('showBlack')
        } else if (balanceAmount.text() < 0) {
            $('.balance').addClass('showRed')
            $('.balance').removeClass('showGreen')
            $('.balance').removeClass('showBlack')
        } else {
            $('.balance').addClass('showBlack')
            $('.balance').removeClass('showRed')
            $('.balance').removeClass('showGreen')
        }
    }

    function showExpense() {
        let totalExpense = 0
        $('.expense-value').each(function(index, value) {
            totalExpense += parseFloat($(value).text())
        })
        
        expenseAmount.text(totalExpense)
    }


    // Budget form submission
    $('#budget-form').on('submit', function(e){
        e.preventDefault()
        const budgetInput = $('#budget-input').val()

        if(budgetInput !== "" && budgetInput >= 0){
            budgetAmount.text(parseFloat(budgetInput))
    
            showBalance()
            $('#budget-input').val("")
        } else {
            budgetFeedback.text('The input field cannot be empty or negative')
            budgetFeedback.show()
            $('#budget-input').val("")
        }
    })
    
    // Expense form submission
    $('#expense-form').on('submit', function(e){
        e.preventDefault()

        const expenseInput = $('#expense-input').val()
        const expenseAmountInput = $('#amount-input').val()

        if(expenseInput !== "" && expenseAmountInput !== ""){
            if(localStorage.getItem('submitted') === "false"){
                const table = $('<table>')
                table.attr('class', 'table')
                table.html(`
                    <thead>
                        <th class="text-center">Expense Title</th>
                        <th class="text-center">Expense Value</th>
                        <th></th>
                    </thead>
                    <tbody id="expense-table-body">
                        <tr>
                            <td class="expense">-${expenseInput}</td>
                            <td class="expense-value expense">${parseFloat(expenseAmountInput)}</td>
                            <td>
                                <i class="fa fa-edit edit-icon edit-icon-btn"></i>
                                <i class="fa fa-trash delete-icon delete-icon-btn"></i>
                            </td>
                        </tr>
                    </tbody>
                `)
                
                $('#tableDiv').append(table)

                localStorage.setItem('submitted', true)
            } else if(editedRowIndex !== null){
                const editedRow = $('#tableDiv tr').eq(editedRowIndex)
                editedRow.find('td:eq(0)').text(expenseInput)
                editedRow.find('td:eq(1)').text(parseFloat(expenseAmountInput))
                editedRowIndex = null
            } else {
                $('#expense-table-body').append(`
                <tr>
                    <td class="expense">-${expenseInput}</td>
                    <td class="expense-value expense">${parseFloat(expenseAmountInput)}</td>
                    <td>
                        <i class="fa fa-edit edit-icon edit-icon-btn"></i>
                        <i class="fa fa-trash delete-icon delete-icon-btn"></i>
                    </td>
                </tr>
                `)
            }

            showExpense()
            showBalance()

            $('#expense-input').val("")
            $('#amount-input').val("")

        } else {
            expenseFeedback.text('Both fields are required!')
            expenseFeedback.show()
        }
    })

    // Delete button event listener
    $(document).on('click', '.delete-icon-btn', function() {
        $(this).closest('tr').remove()
        showExpense()
        showBalance()
    })

    // Edit button event listener
    $(document).on('click', '.edit-icon-btn', function () {
        const row = $(this).closest('tr')
        const expenseInput = row.find('td:eq(0)').text()
        const expenseAmountInput = row.find('td:eq(1)').text()

        $('#expense-input').val(expenseInput)
        $('#amount-input').val(expenseAmountInput)

        editedRowIndex = row.index() + 1 
    })


    // Error feedbacks
    $('#budget-input').on('focus', function(e){
        budgetFeedback.hide()
    })
    $('#expense-input').on('focus', function(e){
        expenseFeedback.hide()
    })
    $('#amount-input').on('focus', function(e){
        expenseFeedback.hide()
    })


})