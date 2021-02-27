<table>
    <thead>
        <tr ><TH align="center" COLSPAN=8><strong>CABECERA DEL LOTE N° {{$id}}</strong></TH></tr>
    <tr>
         <td><b>N° Lote</b></td>
         <td><b>Tipo</b></td>
         <td><b>Proveedor</b></td>
         <td><b>Procedencia</b></td>                                       
         <td><b>Placa</b></td>
         <td><b>Conductor</b></td>
         <td><b>Usuario</b></td>
         <td><b>Fecha de Registro</b></td>
       </tr>
    </thead>
    <tbody>
     @foreach ($lotes as $lote)
        <tr>
            <td >{{ $lote->id }}</td>
            <td >{{ $lote->tipo }}</td>
            <td >{{ $lote->proveedor }}</td>
            <td>{{ $lote->procedencia }}</td>                                           
            <td>{{ $lote->placa }}</td>
            <td>{{ $lote->conductor }}</td>
            <td>{{ $lote->usuario }}</td>
            <td>{{ $lote->created_at }}</td>
        </tr>
      @endforeach
    </tbody>
</table>
<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=7><strong>DETALLE</strong></TH></tr>
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
    @foreach ($registros as $reg)
     <tr>
         
         <td>{{ $reg->lotes_id }}</td>
         <td>{{ $reg->cant_gavetas }}</td>
         <td>{{ $reg->peso_bruto }}</td>
         <td>{{ $reg->peso_gavetas }}</td>
         <td>{{ $reg->peso_final }}</td>
         <td>{{ $reg->usuario }}</td>
         <td>{{ $reg->updated_at }}</td>
     </tr>
     @endforeach
     <tr>
         <td colspan="1"><b>TOTAL</b></td>
         <td><b>{{ $total_cantidad }}</b></td>
         <td><b>{{ $total_bruto }}</b></td>
         <td><b>{{ $total_gavetas }}</b></td>
         <td><b>{{ $total_final }}</b></td>
     </tr>
    </tbody>
</table>

