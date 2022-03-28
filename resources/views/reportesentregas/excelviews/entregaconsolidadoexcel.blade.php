<table >
    <thead>
        <tr> 
            <th align="left" width="30"><b> Entrega N°  {{ $id }} </b></th>
            <td width="35"></td>
            <td width="15"></td>
            <td width="30"></td>
            <td width="20"></td>
            <td width="20"></td>
        </tr>
    </thead>
    <tbody>
            @foreach($entregas as $entrega)
               <tr>
                    <th align="left" ><b>Fecha:</b></th>
                    <td align="right">{{ $entrega->created_at }}</td>
                </tr>
                <tr>
                    <th align="left"><b>Tipo animal:</b></th>
                    <td align="right">{{ $entrega->tipo}} </td>
                </tr>
                <tr>
                    <th align="left"><b>Cliente:</b></th>
                    <td align="right">{{ $entrega->cliente}}</td>
                </tr>
                <tr>
                    <th align="left"><b>Ruc/CI:</b></th>
                    <td align="right">{{ $entrega->ruc_ci }} </td>
                </tr>
                <tr>
                    <th align="left"><b>Cantidad Animales:</b></th>
                    <td align="right">{{ $entrega->cant_animales }}</td>
                </tr>
                <tr>
                    <th align="left"><b>Estado:</b></th>
                    <td align="right"> {{ $liquidado }} </td>
                </tr>
                <tr>
                    <th align="left"><b>Para Local</b></th>
                    <td align="right">
                        @if( $entrega->tipo_entrega == 1 ) 
                            Si 
                        @else 
                            No
                          @endif 
                    </td>
                </tr>  
            @endforeach
                <tr></tr>
                <tr>
                    <th align="center" colspan="3"><b>REGISTRO PESOS</b></th>  
                </tr>
                <tr>
                    <th align="right" colspan="2"><b>Cantidad Gavetas:</b></th>
                    <td align="center">{{ $eCantidad_gavetas }}</td>
                </tr>
                <tr>
                    <th align="right" colspan="2"><b>Peso Bruto (PB):</b></th>
                    <td align="center">{{ $PB }}</td>
                </tr>
                <tr></tr>
                <tr>
                    <th align="center" colspan="3"><b>PESO DE PRESAS</b></th>
                </tr>
                <tr>
                    <th align="center" ><b>Tipo</b></th>  
                    <th align="center" ><b>Cantidad Gavetas</b></th>
                    <th align="center" ><b>Peso (PP)</b></th>  
                </tr>
            @foreach( $grupo_presas as $presa)
                <tr>                
                    <td align="left">{{ $presa->tipo_entrega }}</td>
                    <td align="center">{{ $presa->cant_gavetas }}</td>
                    <td align="center">{{ $presa->peso_bruto }}  </td>
                </tr>
            @endforeach            
                <tr>
                    <th align="center"><b>TOTAL</b></th>
                    <td align="center"><b> {{ $Total_cgaveta_presas }}</b></td>
                    <td align="center"><b>{{ $PP }}</b></td>
                </tr>
                <tr>
                </tr>
                <tr>
                    <th align="center" colspan="2"><b>TOTAL NETO(PB+PP)</b></th>
                    <td align="center"><b>{{ $TPN }}</b></td>
                </tr>
    </tbody>
</table>
