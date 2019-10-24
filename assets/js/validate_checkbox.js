//validate submit form upload and delete
function submitForm() {
        var flag=0;
        $('.checkbox').each(function(){
            if(($(this).is(':checked'))){
                flag=1;
            }
        });
        if(flag==0){
            alert("Please check checkbox");
            return false;
        }
        if(confirm('Are you sure?')) {
            $('#form').submit();
            return true;
        }
        return false;
    }