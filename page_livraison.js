$(function(){
    var tab;

    $("#arr_select").focusout(function(){

        verif();
    });
    $("#arr2_select").focusout(function(){

        verif2();
    });

    function verif(){
        var arr=$("#arr_select").val();

        if(arr=="DAKAR"){

            tab=["medina","fass","colobane"];
        }else if(arr=="PIKINE"){
            tab=["jojo","juju","jaja"];
        }else if(arr=="PIKINE"){
            tab=["frfr","srsr","pama"];
        }

       

    }

    function verif2(){
        var arr=$("#arr2_select").val();

        if(arr=="DAKAR"){

            tab=["medina","fass","colobane"];
        }else if(arr=="PIKINE"){
            tab=["jojo","juju","jaja"];
        }else if(arr=="PIKINE"){
            tab=["frfr","srsr","pama"];
        }

       

    }

});