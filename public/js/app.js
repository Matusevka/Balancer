$(function() {

    async function get_add_form(act = 'add')
    {        
        let response = await fetch(act, { });
        return await response.text();
    }
    
    $('#btn-add-work-car').click(function(event){
        $('#form-add .card').html('');
        get_add_form().then(response => {
            if(response)
            {
                $('#form-add .card').html(response);
                $('#form-add').modal('show');
            }
        });
    });

    $('#btn-add-process').click(function(event){
        $('#form-add .card').html('');
        get_add_form('processes/add').then(response => {
            if(response)
            {
                $('#form-add .card').html(response);
                $('#form-add').modal('show');
            }
        });
    });
});