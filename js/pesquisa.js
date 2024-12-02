$(document).ready(function (){
    $("#pesquisa").keyup(function (){
        let pesquisaTxt = $(this).val();
        if(pesquisaTxt != ""){
            $.ajax({
                url: "/TechWay/src/action.php",
                method: "POST",
                data: {
                    query: pesquisaTxt,
                },
                success: function(response) {
                    $("#lista").html(response);
                },
            });
        }else{
            $("#lista").html();
        }
    });

    $("#lista").on("click", "a", function (){
        $("#pesquisa").val($(this).text());
        $("#lista").html("");
        $("#btnPesquisa").click();
    });
});