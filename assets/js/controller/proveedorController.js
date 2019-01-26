let myApp = angular.module('myApp',[]);
myApp.controller('proveedorController',['$scope','$http','$filter','$window',function ($scope,$http,$filter,$window) {
    $scope.url=$('#url').val();

    $scope.ruc;
    $scope.razonsocial;
    $scope.email;
    $scope.telefono;
    $scope.direccion;

    $scope.getDetalles= (id)=>{
        $http.get($scope.url+"documento/proveedor/detalles/"+id).then(($req)=>{
            //console.log($req.data);
            $scope.ruc=$req.data.ruc;
            $scope.razonsocial=$req.data.razonsocial;
            $scope.telefono=$req.data.telefono;
            $scope.email=$req.data.email;
            $scope.direccion=$req.data.direccion;
        })
    };
}]);

jQuery(document).ready(function(){

    jQuery(document).on("click", ".deleteProveedor", function(){
        let id = $(this).data("id"),
            row = $(this);
        if(confirm("¿Seguro de eliminar el registro?"))
        {
            jQuery.ajax({
                type : "POST",
                dataType : "json",
                url : baseURL + "documento/proveedor/delete",
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
