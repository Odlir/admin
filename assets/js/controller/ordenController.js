let ordenApp = angular.module('ordenApp',[]);
ordenApp.controller('ordenController',['$scope','$http','$filter',function ($scope,$http,$filter) {
    $scope.productos=[];
    $scope.productos_seleccionados=[];
    $scope.url=$('#url').val();

    $scope.productos= ()=>{
        $http.get($scope.url+"inventario/producto/all").then(($req)=>{
            $scope.productos=$req.data;
        })
    };
    $scope.producto_seleccionar=($id)=>{
        let producto_seleccionado=$filter('filter')($scope.productos,{
            producto_id:$id
        })[0];
        let producto_nuevo={
            producto_id: producto_seleccionado.producto_id,
            codigo: producto_seleccionado.codigo,
            nombre: producto_seleccionado.nombre,
            cantidad:1,
            comentario:''
        };

        $scope.productos_seleccionados.push(producto_nuevo);
        //console.log($scope.productos_seleccionados);
        $('#productoModal').modal('hide');
    }
    $scope.removeProducto=($index)=>{
        $scope.productos_seleccionados.splice($index,1);
    }
}]);