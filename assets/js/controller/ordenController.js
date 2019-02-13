
let ordenApp = angular.module('ordenApp',[]);
ordenApp.controller('ordenController',['$scope','$http','$filter','$window',function ($scope,$http,$filter,$window) {
    $scope.detalles=[];
    $scope.orden_id;
    $scope.obra;
    $scope.proveedor;
    $scope.fecha;
    $scope.usuario;
    $scope.url=$('#url').val();
    $scope.getDetalles= (pedido_id)=>{
        $http.get($scope.url+"documento/orden/detalles/"+pedido_id).then(($req)=>{
            //console.log($req.data);
            $scope.obra=$req.data.obra;
            $scope.orden_id=pedido_id;
            $scope.proveedor=$req.data.proveedor;
            $scope.fecha=$req.data.fecha;
            $scope.usuario=$req.data.usuario;
            $scope.detalles=$req.data.detalles;
        })
    };
}]);
ordenApp.controller('ordendetController',['$scope','$http','$filter','$window',function ($scope,$http,$filter,$window) {
    $scope.productos=[];
    $scope.productos_seleccionados=[];
    $scope.url=$('#url').val();
    $scope.orden_id=$('#pedido_id').val();

    $scope.productos= ()=>{
        $http.get($scope.url+"inventario/producto/all").then(($req)=>{
            $scope.productos=$req.data;
        })
    };
    $scope.producto_agregar=($id)=>{
        let producto_yaexiste = $filter('filter')($scope.productos_seleccionados, {
            producto_id: $id,
            activo:1
        })[0];
        //console.log('producto ya existe?',producto_yaexiste);
        if(!producto_yaexiste) {
            //console.log('no existe')
            let producto_seleccionado = $filter('filter')($scope.productos, {
                producto_id: $id
            })[0];
            let producto_nuevo = {
                pedidodetalle_id: 0,
                producto_id: producto_seleccionado.producto_id,
                codigo: producto_seleccionado.codigo,
                nombre: producto_seleccionado.nombre,
                cantidad: 1,
                comentario: '',
                activo: 1
            };
            $scope.productos_seleccionados.push(producto_nuevo);
            //$('#productoModal').modal('hide');
        }
    };
    $scope.removeProducto=(producto)=>{
        $scope.productos_seleccionados.forEach(function(item, index, object) {
            if(item.producto_id==producto.producto_id){
                if(item.pedidodetalle_id==0){
                    //console.log('eliminar fisico');
                    object.splice(index,1);
                }else if(item.activo==1){
                    //console.log('eliminar logico');
                    item.activo=0;
                }
            }
        });
    };
    $scope.filter_productoagregados= function(item) {
        //si el producto_id no esta seleccionado
        let pos = $scope.productos_seleccionados.map(function (e) {
            if(e.activo==0)
                return 0;
            else
                return e.producto_id;
        }).indexOf(item.producto_id);
        return (pos == -1);
    };
    $window.onload = function() {
        if($scope.orden_id != 0){
            $http.get($scope.url+"documento/orden/detalles/"+$scope.orden_id).then(($req)=>{
                //console.log($req.data.detalles);
                $.each($req.data.detalles, function(index, item) {
                    let producto_nuevo={
                        pedidodetalle_id: parseInt(item['pedidodetalle_id']),
                        producto_id: item['producto_id'],
                        codigo: item['codigo'],
                        nombre: item['nombre'],
                        cantidad: parseInt(item['cantidad']),
                        comentario:item['comentario'],
                        activo:parseInt(item['activo'])
                    };
                    $scope.productos_seleccionados.push(producto_nuevo);
                });
            });
        }
    };
}]);

jQuery(document).ready(function(){

    jQuery(document).on("click", ".deleteOrden", function(){
        let id = $(this).data("id"),
            row = $(this);
        if(confirm("¿Seguro de eliminar el registro?"))
        {
            jQuery.ajax({
                type : "POST",
                dataType : "json",
                url : baseURL + "documento/orden/delete",
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
    jQuery(document).on("click", ".aprobarOrden", function(){
        let id = $(this).data("id"),
            row = $(this);
        if(confirm("¿Seguro de aprobar el registro?"))
        {
            jQuery.ajax({
                type : "POST",
                dataType : "json",
                url : baseURL + "documento/orden/aprobar",
                data : { id : id}
            }).done(function(data){
                if(data.status = true) {
                    window.location.href =baseURL+"ordenListing";
                    //row.parents('tr').remove();
                    //alert("Eliminación satisfactoria");
                }
                else if(data.status = false) { alert("Eliminación fallida"); }
                else { alert("Access denied..!"); }

            }).error(function(data){
                console.log('error',data);
        });

        }
    });


});
