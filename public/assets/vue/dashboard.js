$(function(){
    $("#latest_payments").DataTable({
        layout: {
            topStart: {
                buttons: ['csv', 'excel']
            }
        }
    })
})