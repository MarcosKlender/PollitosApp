<table>
    <thead>
        <tr ><TH align="center" COLSPAN=11><strong>CABECERA ENTREGA N° {{$id}}</strong></TH></tr>
    <tr>
         <td align="center"><b>N°</b></td>
         <td align="center" width="25"><b>Tipo</b></td>
         <td align="center" width="20"><b>Cantidad Animales</b></td>
         <td align="center" width="30"><b>Cliente</b></td>
         <td align="center" width="20"><b>RUC/CI</b></td>
         <td align="center" width="20"><b>Destino</b></td>                                       
         <td align="center"><b>Placa</b></td>
         <td align="center" width="30"><b>Conductor</b></td>
         <td align="center"><b>Estado</b></td>
         <td align="center"><b>Usuario</b></td>
         <td align="center" width="30"><b>Fecha de Registro</b></td>
       </tr>
    </thead>
    <tbody>
     @foreach ($entregas as $entrega)
        <tr>
            <td align="center">{{ $entrega->id }}</td>
            <td align="center">{{ $entrega->tipo }}</td>
            <td align="center">{{ $entrega->cant_animales }}</td>
            <td align="center">{{ $entrega->cliente }}</td>
            <td align="center">{{ $entrega->ruc_ci }}</td>
            <td align="center">{{ $entrega->destino }}</td>                                           
            <td align="center">{{ $entrega->placa }}</td>
            <td align="center">{{ $entrega->conductor }}</td>
            <td align="center">{{ $liquidado }}</td>
            <td align="center">{{ $entrega->usuario }}</td>
            <td align="center">{{ $entrega->created_at }}</td>
        </tr>
      @endforeach
    </tbody>
</table>
        

<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=5 ><strong>REGISTRO DE PESOS</strong></TH></tr>
    <tr>
        <td align="center" bgcolor="yellow"><b>ID</b></td>
        <td align="center" bgcolor="yellow"><b>Cantidad de Gavetas</b></td>
        <td align="center" bgcolor="yellow"><b>Peso Bruto</b></td>
        <td align="center" bgcolor="yellow"><b>Usuario</b></td>
        <td align="center" bgcolor="yellow"><b>Fecha de Registro</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach ($registros as $reg)
    @if( $reg->anulado == 0)
     <tr>         
         <td align="center">{{ $reg->entregas_id }}</td>
         <td align="center">{{ $reg->cant_gavetas }}</td>
         <td align="center">{{ $reg->peso_bruto }}</td>
         <td align="center">{{ $reg->usuario }}</td>
         <td align="center">{{ $reg->updated_at }}</td>         
     </tr>
     @endif
     @endforeach
     <tr>
         <td align="center" colspan="1"><b>TOTAL</b></td>
         <td align="center"><b>{{ $total_cantidad }}</b></td>
         <td align="center"><b>{{ $total_bruto }}</b></td>
     </tr>
    </tbody>
</table>

<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=6><strong>PESO DE PRESAS</strong></TH></tr>
    <tr>
        <td align="center" bgcolor="yellow"><b>ID</b></td>
        <td align="center" bgcolor="yellow"><b>Tipo entrega</b></td>
        <td align="center" bgcolor="yellow"><b>Cantidad de Gavetas</b></td>
        <td align="center" bgcolor="yellow"><b>Peso neto </b></td>
        <td align="center" bgcolor="yellow"><b>Usuario</b></td>
        <td align="center" bgcolor="yellow"><b>Fecha de Registro</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach( $presas as $presa)
    @if( $presa->anulado == 0)
     <tr>         
         <td align="center">{{ $presa->entregas_id }}</td>
         <td align="center">{{ $presa->tipo_entrega}}</td>
         <td align="center">{{ $presa->cant_gavetas }}</td>
         <td align="center">{{ $presa->peso_bruto }}</td>
         <td align="center">{{ $presa->usuario }}</td>
         <td align="center">{{ $presa->updated_at }}</td>         
     </tr>
     @endif
     @endforeach
     <tr>
         <td align="center" colspan="2"><b>TOTAL</b></td>
         <td align="center"><b>{{ $total_cantidad_pentrega }}</b></td>
         <td align="center"><b>{{ $total_peso_pentrega }}</b></td>
     </tr>
    </tbody>
</table>
