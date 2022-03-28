<table>
    <thead>
        <tr ><TH align="center" COLSPAN=5><strong>CABECERA DEL LOTE N° {{$id}}</strong></TH></tr>

    </thead>
    <tbody>
     @foreach ($lotes as $lote)
        <tr>
            <th scope="row" width="25"><b>Tipo:</b></th>
            <td align="center">{{ $lote->tipo }}</td>

            <th><b>Placa:</b></th>                                               
            <td width="35" align="center">{{ $lote->placa }}</td>
        </tr>

        <tr>
            <th width="20"><b>Cantidad Animales(INGRESOS):</b></th>
            <td align="center">{{ $lote->cantidad }}</td>

            <th width="30"><b>Conductor:</b></th>
            <td  width="40" align="center">{{ $lote->conductor }}</td>
        </tr>

        <tr>   
             <th width="30"><b>Proveedor:</b></th>
            <td width="45" align="center">{{ $lote->proveedor }}</td>

            <th><b>Estado</b></th>
            <td align="center">{{ $liquidado }}</td>
        </tr>

        <tr>
            <th width="20"><b>RUC/CI:</b></th>
            <td align="center">{{ $lote->ruc_ci }}</td>

            <th><b>Usuario creación:</b></th>
            <td align="center">{{ $lote->usuario_creacion }}</td>
        </tr>

        <tr>
            <th width="20"><b>Procedencia:</b></th>
            <td align="center">{{ $lote->procedencia }}</td>

            <th width="30"><b>Fecha de creación:</b></th>
            <td align="center">{{ $lote->created_at }}</td>
        </tr>
               
      @endforeach
    </tbody>
</table>
        
<table border="1">
    <thead>
        <tr ><TH align="left" COLSPAN=4><strong> INGRESOS </strong></TH></tr>

        <tr align="center"><TH COLSPAN=4><strong> CANTIDAD AHOGADOS  </strong></TH></tr>
    <tr>
        <td align="center" ><b>Cantidad ahogados</b></td>
        <td align="center" ><b>Peso ahogados</b></td>
        <td align="center" ><b>Usuario creación</b></td>
        <td align="center" ><b>Fecha creación</b></td>
    </tr>
    </thead>
    <tbody>
   @foreach ($lotes as $lote_ahogado)
    @if( $lote_ahogado->anulado == 0)
     <tr>         
         <td align="center">{{ $lote_ahogado->cant_ahogados }}</td>
         <td align="center">{{ $lote_ahogado->peso_ahogados }}</td>
         <td align="center">{{ $lote_ahogado->usuario_creacion }}</td>
         <td align="center">{{ $lote_ahogado->updated_at }}</td>         
     </tr>
     @endif
     @endforeach
    </tbody>
</table>

<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=5 ><strong>REGISTRO DE ANIMALES VIVOS</strong></TH></tr>
    <tr>
        <td align="center" ><b>N°</b></td>
        <td align="center" ><b>Cantidad de Gavetas</b></td>
        <td align="center" ><b>Peso Bruto</b></td>
        <td align="center" ><b>Usuario creación</b></td>
        <td align="center" ><b>Fecha creación</b></td>
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
        <tr align="center"><TH align="center" COLSPAN=5><strong>PESO GAVETAS VACIAS</strong></TH></tr>
    <tr>
        <td align="center" ><b>N°</b></td>
        <td align="center" ><b>Cantidad de Gavetas vacías</b></td>
        <td align="center" ><b>Peso gavetas vacías</b></td>
        <td align="center" ><b>Usuario creación</b></td>
        <td align="center" ><b>Fecha creación</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach ($gavetas_vacias as $gav_vacias)
    @if( $gav_vacias->anulado == 0)
     <tr>        
         <td align="center">{{ $loop->iteration }}</td> 
         <td align="center">{{ $gav_vacias->cant_gavetas_vacias }}</td>
         <td align="center">{{ $gav_vacias->peso_gavetas_vacias }}</td>
         <td align="center">{{ $gav_vacias->usuario_creacion }}</td>
         <td align="center">{{ $gav_vacias->updated_at }}</td>         
     </tr>
     @endif
     @endforeach
     <tr>
         <td align="center" colspan="1"><b>TOTAL</b></td>
         <td align="center"><b>{{ $total_can_gav_vacia }}</b></td>
         <td align="center"><b>{{ $total_pes_gav_vacia }}</b></td>
     </tr>
    </tbody>
</table>

<table border="1">
    <thead>
        <tr><TH align="left" COLSPAN=5><strong> EGRESOS </strong></TH></tr>

        <tr ><TH align="center" COLSPAN=5><strong> ANIMALES AHOGADOS </strong></TH></tr>
    <tr>
        <td align="center" ><b>Cantidad ahogados</b></td>
        <td align="center" ><b>Peso ahogados</b></td>
        <td align="center" ><b>Cantidad gavetas vacias</b></td>
        <td align="center" ><b>Usuario creación</b></td>
        <td width="20" align="center" ><b>Fecha creación</b></td>
    </tr>
    </thead>
    <tbody>
   @foreach ($egresos_presas as $lote_ahogado_egreso)
     <tr>         
         <td align="center">{{ $lote_ahogado_egreso->cant_ahogados_egresos }}</td>
         <td align="center">{{ $lote_ahogado_egreso->peso_ahogados_egresos }}</td>
         <td align="center">{{ $lote_ahogado_egreso->cant_gvacia_ahogados_egresos }}</td>
         <td align="center">{{ $lote_ahogado_egreso->usuario_creacion }}</td>
         <td align="center">{{ $lote_ahogado_egreso->updated_at }}</td>         
     </tr>
     @endforeach
    </tbody>
</table>

<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=5><strong> ANIMALES ESTROPEADOS</strong></TH></tr>
    <tr>
        <td align="center" ><b>Cantidad estropeados</b></td>
        <td align="center" ><b>Peso estropeados</b></td>
        <td align="center" ><b>Cantidad gavetas vacias</b></td>
        <td align="center" ><b>Usuario creación</b></td>
        <td align="center" ><b>Fecha creación</b></td>
    </tr>
    </thead>
    <tbody>
   @foreach ($egresos_presas as $lote_estropeado_egreso)
     <tr>         
         <td align="center">{{ $lote_estropeado_egreso->cant_estropeados_egresos }}</td>
         <td align="center">{{ $lote_estropeado_egreso->peso_estropeados_egresos }}</td>
         <td align="center">{{ $lote_estropeado_egreso->cant_gvacia_estropeados_egresos }}</td>
         <td align="center">{{ $lote_estropeado_egreso->usuario_creacion }}</td>
         <td align="center">{{ $lote_estropeado_egreso->updated_at }}</td>         
     </tr>
     @endforeach
    </tbody>
</table>

<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=4><strong> MOLLEJAS </strong></TH></tr>
    <tr>
        <td align="center" ><b>Peso mollejas</b></td>
        <td align="center" ><b>Peso gavetas vacias</b></td>
        <td align="center" ><b>Usuario creación</b></td>
        <td align="center" ><b>Fecha creación</b></td>
    </tr>
    </thead>
    <tbody>
   @foreach ($egresos_presas as $lote_molleja_egreso)
     <tr>         
         <td align="center">{{ $lote_molleja_egreso->peso_mollejas_egresos }}</td>
         <td align="center">{{ $lote_molleja_egreso->peso_gvacia_mollejas_egresos }}</td>
         <td align="center">{{ $lote_molleja_egreso->usuario_creacion }}</td>
         <td align="center">{{ $lote_molleja_egreso->updated_at }}</td>         
     </tr>
     @endforeach
    </tbody>
</table>

<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=5><strong>REGISTRO DE ANIMALES FAENADOS</strong></TH></tr>
    <tr>
        <td align="center" ><b>N°</b></td>
        <td align="center" ><b>Cantidad Gavetas</b></td>
        <td align="center" ><b>Peso Bruto</b></td>
        <td align="center" ><b>Usuario creación</b></td>
        <td align="center" ><b>Fecha de creación</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach ($egresos as $egr)
     <tr>
         <td align="center"> {{ $loop->iteration }} </td>
         <td align="center">{{ $egr->cant_gavetas }}</td>
         <td align="center">{{ $egr->peso_bruto }}</td>
         <td align="center">{{ $egr->usuario_creacion }}</td>
         <td>{{ $egr->updated_at }}</td>
     </tr>
     @endforeach
     <tr>
         <td align="center" colspan="1"><b>TOTAL</b></td>
         <td align="center"><b>{{ $totale_cantidad }}</b></td>
         <td align="center"><b>{{ $totale_bruto }}</b></td>
     </tr>
    </tbody>
</table> 

<table border="1">
    <thead>
        <tr align="center"><TH align="center" COLSPAN=5><strong>PESO GAVETAS VACIAS </strong></TH></tr>
    <tr>
        <td align="center" ><b>N°</b> </td>
        <td align="center" ><b>Cantidad Gavetas vacías</b></td>
        <td align="center" ><b>Peso gavetas vacías</b></td>
        <td align="center" ><b>Usuario creación</b></td>
        <td align="center" ><b>Fecha creación</b></td>
    </tr>
    </thead>
    <tbody>
    @foreach ($gavetas_vacias_egresos as $gav_vacias)
    @if( $gav_vacias->anulado == 0)
     <tr>         
         <td align="center">{{ $loop->iteration}}</td>
         <td align="center">{{ $gav_vacias->cant_gavetas_vacias }}</td>
         <td align="center">{{ $gav_vacias->peso_gavetas_vacias }}</td>
         <td align="center">{{ $gav_vacias->usuario_creacion }}</td>
         <td align="center">{{ $gav_vacias->updated_at }}</td>         
     </tr>
     @endif
     @endforeach
     <tr>
         <td align="center" colspan="1"><b>TOTAL</b></td>
         <td align="center"><b>{{ $total_can_gav_vacia_egreso }}</b></td>
         <td align="center"><b>{{ $total_pes_gav_vacia_egreso }}</b></td>
     </tr>
    </tbody>
</table>