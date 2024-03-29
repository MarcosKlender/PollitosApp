<table >
    <thead>
        <tr> 
            <th align="left" width="44"> Lote N°  {{ $id }}  </th>
            <td width="30"></td>
            <td width="2"></td>
            <td width="47"></td>
            <td width="25"></td>
            <td width="2"></td>
            <td width="23"></td>
            <td width="36"></td>
            <td width="23"></td>
            <td width="23"></td>
        </tr>
    </thead>
    <tbody>
        @foreach($lotes as $lote)
            <tr>
                <th align="left" >Fecha:</th>
                <td align="right"> {{ $lote->created_at}} </td>
            </tr>
            <tr>
                <th align="left">Tipo animal: </th>
                <td align="right"> {{ $lote->tipo}} </td>
            </tr>
            <tr>
                <th align="left">Proveedor: </th>
                <td align="right"> {{ $lote->proveedor }} </td>
            </tr>
            <tr>
                <th align="left">Ruc: </th>
                <td style="mso-number-format:'0%';" align="right"> {{ $lote->ruc_ci }} </td>
            </tr>
            <tr>
                <th align="left">Cantidad Animales (INGRESOS): </th>
                <td align="right"> {{ $lote->cantidad }} </td>
            </tr>
            <tr>
                <th align="left">Cantidad Animales (EGRESOS): </th>
                <td align="right"> {{ $lote->cant_animales_egresos }} </td>
            </tr>
            <tr>
                <th align="left">Estado: </th>
                <td align="right"> {{ $liquidado}} </td>
            </tr>
        @endforeach
            <tr>
                <th align="center" colspan="2">INGRESO</th>
                <th></th>
                <th align="center" colspan="7">EGRESO</th>  
            </tr>
            <tr>
                <th align="center" colspan="2">REGISTRO DE ANIMALES VIVOS</th>
                <th></th>
                <th align="center" colspan="2">REGISTRO DE ANIMALES FANEADOS</th>  
                <th></th>
                <th align="center" colspan="4">REGISTRO DE ANIMALES AHOGADOS</th>  
            </tr>
            <tr>
                <th align="center">Cantidad de gavetas con animales</th>
                <th align="center">Peso Bruto (iPB)</th>  
                <th></th>
                <th align="center">Cantidad gavetas llenas</th> 
                <th align="center" >Peso Bruto (ePB)</th>   
                <th></th>
                <th align="center">Cantidad gavetas vacías</th>
                <th align="center">Peso gavetas vacias ahogados (ePGVAH) </th> 
                <th align="center" >Cantidad ahogados</th> 
                <th align="center" >Peso Ahogados (ePH)</th> 
            </tr>
            <tr>
                <td align="center"> {{ $iCantidadga}}</td>
                <td align="center"> {{ $iPB}} </td>
                <td align="center"></td>
                <td align="center"> {{ $eCantidad_gavetas }}</td>
                <td align="center"> {{ $ePB }}</td>
                <td align="center">  </td>
                <td align="center">{{ $eTotal_Cgvacia_ahogados }}</td>
                <td align="center">{{ $ePeso_gvacia_ahogados_egresos}}</td>
                <td align="center">{{ $eCantidad_ahogados }}</td>
                <td align="center">{{ $ePeso_ahogados }}</td>
            </tr>
            <tr>
                <th align="center" colspan="2">PESO GAVETAS VACIAS</th>
                <th></th>
                <th align="center" colspan="2">PESO GAVETAS VACIAS</th>  
                <th></th>
                <th align="center" colspan="4">REGISTRO DE ANIMALES ESTROPEADOS</th>  
            </tr>
            <tr>
                <th align="center">Cantidad de gavetas vacías</th>
                <th align="center">Peso gavetas vacías (iPGV)</th>  
                <th></th>
                <th align="center">Cantidad Gavetas vacías</th> 
                <th align="center" >Peso gavetas vacías (ePGV)</th>   
                <th></th>
                <th align="center">Cantidad gavetas vacías</th> 
                <th align="center">Peso gavetas vacías estropeados (ePGVE)</th>
                <th align="center" >Cantidad estropeados</th> 
                <th align="center" >Peso estropeados (ePE)</th> 
            </tr>
            <tr>
                <td align="center"> {{ $iTotal_Cgvacia }}</td>
                <td align="center"> {{ $iPGV}} </td>
                <td align="center"></td>
                <td align="center">{{ $eCantidad_gvacias }}</td>
                <td align="center">{{ $ePGV }}</td>
                <td align="center"></td>
                <td align="center">{{ $eCantidad_gvacia_estropeados}}</td>
                <td align="center">{{ $ePeso_gvacia_estropeados }} </td>
                <td align="center">{{ $eCantidad_estropeados }}</td>
                <td align="center">{{ $ePE }}</td>
            </tr>
            <tr>
                <th align="center" colspan="2">CANTIDAD AHOGADOS</th>
                <th></th>
                <th align="center" colspan="2">MOLLEJAS</th>  
                <th></th>
                <th align="center" colspan="3">TOTAL DESPERDICIO | eTD=(ePH+ePE)-(ePGVE+ePGVAH)</th>
                <td align="center">{{ $eTD }}</td>  
            </tr>
            <tr>
                <th align="center">Cantidad ahogados</th>
                <th align="center">Peso ahogados (iPH)</th>  
                <th></th>
                <th align="center">Peso Gavetas vacías (ePGVM)</th> 
                <th align="center" >Peso mollejas (ePM)</th>   
                <th></th>
                <th></th> 
                <th></th> 
                <th></th> 
            </tr>
            <tr>
                <td align="center">{{ $iCantidad_ahogados}}</td>
                <td align="center">{{ $iPH }}</td>
                <td align="center"></td>
                <td align="center">{{ $ePeso_gvacia_mollejas }}</td>
                <td align="center">{{ $ePM }} </td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
                <td align="center"></td>
            </tr>
            <tr>
                <th align="center">TOTAL PESO NETO | iTPN=(iPB-iPGV-iPH) </th>
                <td align="center"> {{ $iTPN }} </td>  
                <th></th>
                <th align="center">TOTAL PESO NETO | eTPN=(ePB-ePGV-ePGVM)+ePM</th> 
                <td align="center">{{ $eTPN }}</td> 
                <th></th> 
                <th></th> 
                <th></th> 
            </tr>
            <tr></tr>
            <tr>
                <th align="center">MERMA POR ANIMAL | ieMA = (iTPN - eTPN) / eCA</th>
                <td align="center">{{ $ieMA }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
    </tbody>
</table>