<table>
    <thead>
    <tr>
        <th align="center" COLSPAN=6><strong>ENTREGA N° {{$id}}</strong></th>
    </tr>
    </thead>
    <tbody>
     @foreach ($entregas as $entrega)
        <tr>
            <th align="left" width="25"><b>Tipo: </b></th>
            <td align="left" width="30">{{ $entrega->tipo }}</td>
            <th align="left" width="25"><b>Cantidad Animales: </b></th>
            <td align="left" width="25">{{ $entrega->cant_animales }}</td>
            <th width="20"></th>
            <th width="20"></th>
        </tr>
        <tr>
            <th align="left"><b>Cliente: </b></th>   
            <td align="left">{{ $entrega->cliente }}</td>
            <th align="left"><b>Destino: </b></th>                                          
            <td align="left">{{ $entrega->destino }}</td>
        </tr>
        <tr>
            <th align="left"><b>RUC/CI: </b></th> 
            <td align="left">{{ $entrega->ruc_ci }}</td>
            <th align="left"><b>Placa</b></th>                                           
            <td align="left">{{ $entrega->placa }}</td>
        </tr>
        <tr>
            <th align="left"><b>Conductor: </b></th>
            <td align="left">{{ $entrega->conductor }}</td>
            <th align="left"><b>Usuario creación: </b></th>
            <td align="left">{{ $entrega->usuario_creacion }}</td> 

        </tr>
        <tr>
            <th align="left"><b>Fecha de Registro: </b></th>
            <td align="left">{{ $entrega->created_at }}</td> 
            <th align="left"><b>Estado: </b></th>         
            <td align="left">{{ $liquidado }}</td>          
        </tr>          
      @endforeach
    </tbody>
</table>
        

<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=5 ><strong>REGISTRO DE PESOS</strong></TH></tr>
    <tr>
        <td align="center" bgcolor="yellow"><b>N°</b></td>
        <td align="center" bgcolor="yellow"><b>Cantidad de Gavetas</b></td>
        <td align="center" bgcolor="yellow"><b>Peso Bruto</b></td>
        <td align="center" bgcolor="yellow"><b>Usuario creación</b></td>
        <td align="center" bgcolor="yellow"><b>Fecha de Registro</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach ($registros as $reg)
    @if( $reg->anulado == 0)
     <tr>         
         <td align="center">{{ $loop->iteration }}</td>
         <td align="center">{{ $reg->cant_gavetas }}</td>
         <td align="center">{{ $reg->peso_bruto }}</td>
         <td align="center">{{ $reg->usuario_creacion }}</td>
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
        <td align="center" bgcolor="yellow"><b>N°</b></td>
        <td align="center" bgcolor="yellow"><b>Tipo entrega</b></td>
        <td align="center" bgcolor="yellow"><b>Cantidad de Gavetas</b></td>
        <td align="center" bgcolor="yellow"><b>Peso neto </b></td>
        <td align="center" bgcolor="yellow"><b>Usuario creación</b></td>
        <td align="center" bgcolor="yellow"><b>Fecha de Registro</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach( $presas as $presa)
    @if( $presa->anulado == 0)
     <tr>         
         <td align="center">{{ $loop->iteration }}</td>
         <td align="center">{{ $presa->tipo_entrega}}</td>
         <td align="center">{{ $presa->cant_gavetas }}</td>
         <td align="center">{{ $presa->peso_bruto }}</td>
         <td align="center">{{ $presa->usuario_creacion }}</td>
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
