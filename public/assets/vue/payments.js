$(function(){
    $("#payments").DataTable({
        layout: {
            topStart: {
                buttons: ['csv', 'excel']
            }
        }
    })
})