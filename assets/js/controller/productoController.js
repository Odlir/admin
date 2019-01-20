let myApp = angular.module('myApp',[]);
myApp.controller('productoController',['$scope','$http','$filter','$window',function ($scope,$http,$filter,$window) {
    $scope.url=baseURL;// $('#url').val();

    $scope.codigo;
    $scope.nombre;
    $scope.familia;
    $scope.marca;
    $scope.unidad;
    $scope.comentario;

    $scope.getDetalles= (id)=>{
        $http.get($scope.url+"inventario/producto/detalles/"+id).then(($req)=>{
            //console.log($req.data);
            $scope.codigo=$req.data.codigo;
            $scope.nombre=$req.data.nombre;
            $scope.familia=$req.data.familia;
            $scope.marca=$req.data.marca;
            $scope.unidad=$req.data.unidad;
            $scope.comentario=$req.data.comentario;
        })
    };
}]);


jQuery(document).ready(function(){

    jQuery(document).on("click", ".deleteProduct", function(){
        let id = $(this).data("id"),
            row = $(this);
        if(confirm("¿Seguro de eliminar el registro?"))
        {
            jQuery.ajax({
                type : "POST",
                dataType : "json",
                url : baseURL + "inventario/producto/delete",
                data : { id : id}
            }).done(function(data){
                //console.log(data);
                if(data.status = true) {
                    row.parents('tr').remove();
                    //alert("Eliminación satisfactoria");
                }
                else if(data.status = false) { alert("Eliminación fallida"); }
                else { alert("Access denied..!"); }
            });
        }
    });
    jQuery(document).on("click", ".searchList", function(){

    });

});
