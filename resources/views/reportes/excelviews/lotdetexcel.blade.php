<table>
    <thead>
        <tr ><TH align="center" COLSPAN=11><strong>CABECERA DEL LOTE N° {{$id}}</strong></TH></tr>
    <tr>
         <td><b>N° Lote</b></td>
         <td><b>Tipo</b></td>
         <td><b>Cantidad Animales</b></td>
         <td><b>Proveedor</b></td>
          <td><b>RUC/CI</b></td>
         <td><b>Procedencia</b></td>                                       
         <td><b>Placa</b></td>
         <td><b>Conductor</b></td>
         <td><b>Estado</b></td>
         <td><b>Usuario</b></td>
         <td><b>Fecha de Registro</b></td>
       </tr>
    </thead>
    <tbody>
     @foreach ($lotes as $lote)
        <tr>
            <td >{{ $lote->id }}</td>
            <td >{{ $lote->tipo }}</td>
            <td >{{ $lote->cantidad }}</td>
            <td >{{ $lote->proveedor }}</td>
            <td >{{ $lote->ruc_ci }}</td>
            <td>{{ $lote->procedencia }}</td>                                           
            <td>{{ $lote->placa }}</td>
            <td>{{ $lote->conductor }}</td>
            <td>{{ $liquidado }}</td>
            <td>{{ $lote->usuario }}</td>
            <td>{{ $lote->created_at }}</td>
        </tr>
      @endforeach
    </tbody>
</table>
        
<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=5><strong> CANTIDAD AHOGADOS  </strong></TH></tr>
    <tr>
        <td><b>ID Lote</b></td>
        <td><b>Cantidad ahogados</b></td>
        <td><b>Peso ahogados</b></td>
        <!--td><b>Peso Gavetas</b></td>
        <td><b>Peso Final</b></td!-->
        <td><b>Usuario</b></td>
        <td><b>Fecha de Registro</b></td>
    </tr>
    </thead>
    <tbody>
   @foreach ($lotes as $lote_ahogado)
    @if( $lote_ahogado->anulado == 0)
     <tr>         
         <td>{{ $lote_ahogado->id }}</td>
         <td>{{ $lote_ahogado->cant_ahogados }}</td>
         <td>{{ $lote_ahogado->peso_ahogados }}</td>
         <!--td>{{ $lote_ahogado->peso_gavetas }}</td>
         <td>{{ $lote_ahogado->peso_final }}</td!-->
         <td>{{ $lote_ahogado->usuario }}</td>
         <td>{{ $lote_ahogado->updated_at }}</td>         
     </tr>
     @endif
     @endforeach
     <tr>
         <!--td colspan="1"><b>TOTAL</b></td>
         <td><b>{{ $total_cantidad }}</b></td>
         <td><b>{{ $total_bruto }}</b></td!-->
         <!--td><b>{{ $total_gavetas }}</b></td>
         <td><b>{{ $total_final }}</b></td!-->
     </tr>
    </tbody>
</table>



<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=5><strong>PESO BRUTO</strong></TH></tr>
    <tr>
        <td><b>ID Lote</b></td>
        <td><b>Cantidad de Gavetas</b></td>
        <td><b>Peso Bruto</b></td>
        <!--td><b>Peso Gavetas</b></td>
        <td><b>Peso Final</b></td!-->
        <td><b>Usuario</b></td>
        <td><b>Fecha de Registro</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach ($registros as $reg)
    @if( $reg->anulado == 0)
     <tr>         
         <td>{{ $reg->lotes_id }}</td>
         <td>{{ $reg->cant_gavetas }}</td>
         <td>{{ $reg->peso_bruto }}</td>
         <!--td>{{ $reg->peso_gavetas }}</td>
         <td>{{ $reg->peso_final }}</td!-->
         <td>{{ $reg->usuario }}</td>
         <td>{{ $reg->updated_at }}</td>         
     </tr>
     @endif
     @endforeach
     <tr>
         <td colspan="1"><b>TOTAL</b></td>
         <td><b>{{ $total_cantidad }}</b></td>
         <td><b>{{ $total_bruto }}</b></td>
         <!--td><b>{{ $total_gavetas }}</b></td>
         <td><b>{{ $total_final }}</b></td!-->
     </tr>
    </tbody>
</table>

<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=5><strong>PESO GAVETAS VACIAS</strong></TH></tr>
    <tr>
        <td><b>ID Lote</b></td>
        <td><b>Cantidad de Gavetas vacías</b></td>
        <td><b>Peso gavetas vacías</b></td>
        <!--td><b>Peso Gavetas</b></td>
        <td><b>Peso Final</b></td!-->
        <td><b>Usuario</b></td>
        <td><b>Fecha de Registro</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach ($gavetas_vacias as $gav_vacias)
    @if( $gav_vacias->anulado == 0)
     <tr>         
         <td>{{ $gav_vacias->lotes_id }}</td>
         <td>{{ $gav_vacias->cant_gavetas_vacias }}</td>
         <td>{{ $gav_vacias->peso_gavetas_vacias }}</td>
         <!--td>{{ $reg->peso_gavetas }}</td>
         <td>{{ $reg->peso_final }}</td!-->
         <td>{{ $gav_vacias->usuario }}</td>
         <td>{{ $gav_vacias->updated_at }}</td>         
     </tr>
     @endif
     @endforeach
     <tr>
         <td colspan="1"><b>TOTAL</b></td>
         <td><b>{{ $total_can_gav_vacia }}</b></td>
         <td><b>{{ $total_pes_gav_vacia }}</b></td>
         <!--td><b>{{ $total_gavetas }}</b></td>
         <td><b>{{ $total_final }}</b></td!-->
     </tr>
    </tbody>
</table>


<!--table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=7><strong>DETALLE VISCERAS</strong></TH></tr>
    <tr>
        <td><b>ID Lote</b></td>
        <td><b>Peso Bruto</b></td>
        <td><b>Peso Gavetas</b></td>
        <td><b>Peso Final</b></td>
        <td><b>Usuario</b></td>
        <td><b>Fecha de Registro</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach ($visceras as $vic)
     <tr>

         <td>{{ $vic->lotes_id }}</td>
         <td>{{ $vic->peso_bruto }}</td>
         <td>{{ $vic->peso_gavetas }}</td>
         <td>{{ $vic->peso_final }}</td>
         <td>{{ $vic->usuario }}</td>
         <td>{{ $vic->updated_at }}</td>
     </tr>
     @endforeach
     <tr>
         <td colspan="1"><b>TOTAL</b></td>
         <td><b>{{ $totalv_bruto }}</b></td>
         <td><b>{{ $totalv_gavetas }}</b></td>
         <td><b>{{ $totalv_final }}</b></td>
     </tr>
    </tbody>
</table!-->

<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=7><strong>DETALLE EGRESOS</strong></TH></tr>
    <tr>
        <td><b>ID Lote</b></td>
        <td><b>Cantidad de Gavetas</b></td>
        <td><b>Peso Bruto</b></td>
        <td><b>Peso Gavetas</b></td>
        <td><b>Peso Final</b></td>
        <td><b>Usuario</b></td>
        <td><b>Fecha de Registro</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach ($egresos as $egr)
     <tr>

         <td>{{ $egr->lotes_id }}</td>
         <td>{{ $egr->cant_gavetas }}</td>
         <td>{{ $egr->peso_bruto }}</td>
         <td>{{ $egr->peso_gavetas }}</td>
         <td>{{ $egr->peso_final }}</td>
         <td>{{ $egr->usuario }}</td>
         <td>{{ $egr->updated_at }}</td>
     </tr>
     @endforeach
     <tr>
         <td colspan="1"><b>TOTAL</b></td>
         <td><b>{{ $totale_cantidad }}</b></td>
         <td><b>{{ $totale_bruto }}</b></td>
         <td><b>{{ $totale_gavetas }}</b></td>
         <td><b>{{ $totale_final }}</b></td>
     </tr>
    </tbody>
</table> 