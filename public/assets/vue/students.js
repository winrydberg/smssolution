// JQUERY 
$(function(){
    $("#students").DataTable({
        layout: {
            topStart: {
                buttons: ['csv', 'excel']
            }
        }
    });
})



// new Vue({
//     el: '#vue-section',
//     delimiters: ['[[', ']]'], // I have already set the global config for this
//     data: {
//         selected_fees: []
//     },
//     methods: {
       
//     }
// });
