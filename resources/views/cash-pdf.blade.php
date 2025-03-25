<!doctype html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Franco's Ticket</title>

        <style type="text/css">
            * {
                font-family: Verdana, Arial, sans-serif;
            }
            table{
                font-size: medium;
            }
            tfoot tr td{
                font-weight: bold;
                font-size: medium;
            }
            .gray {
                background-color: lightgray
            }
        </style>
    </head>
    <body>
      <table width="100%">
          <tr>
            <td style="text-align: center;">
              <img src="{{ public_path('images/francos.png') }}" alt="" width="100"/>
            </td>
          </tr>
            <tr>
                <td align="center">
                    <h3>Franco's</h3>
                </td>
            </tr>
            <tr>
                <td align="center" style="border: 1px solid; border-style: dashed solid dashed solid;">
                    <h3> Corte de caja: #{{ $record->id }} </h3>
                </td>
            </tr>
        </table>

        <br>

        <table width="100%">
            <tr>
              <td align="left"><strong>Fecha generado:</strong> {{ $record->created_at->isoFormat('D, MMM h:mm:ss a') }}</td>
            </tr>
        </table>

    	@if($record->user)
            <table width="100%">
                <tr>
                  <td align="left"><strong>@lang('Created by'):</strong> {{ $record->user->name }}</td>
                </tr>
                <tr>
                  <td align="left"><strong>@lang('Initial'):</strong> ${{ $record->initial }}</td>
                </tr>
                <tr>
                  <td align="left"><strong>@lang('Comment'):</strong> {{ $record->comment }}</td>
                </tr>
            </table>
        @endif

        <br>
        <table width="100%">
            <tr>
              <td align="center"><h2><strong>Total órdenes:</strong> {{ $record->total_orders }}</h2></td>
            </tr>
            <tr>
              <td align="center"><h2><strong>Total percibido:</strong> ${{ $record->total_orders_price }}</h2></td>
            </tr>
        </table>


        <br>

        @if(count($record->orders))
            <table width="100%">
                <thead style="background-color: gray;">
                  <tr align="center">
                  	<th colspan="3" style="color: white;">Órdenes</th>
                  </tr>
                </thead>
                <thead style="background-color: gray; color: white;">
                  <tr align="center">
                      <th scope="col">#</th>
                      <th scope="col">@lang('Customer')</th>
                      <th scope="col">@lang('Total')</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($record->orders as $item)
	                  <tr>
                          <th scope="row">{{ $item->id }}</th>
	                      <td>
                            {{ optional($item->customer)->name  ?? '' }}
                            {{ optional($item->user)->name  ?? '' }}</td>
	                      <td>
	                        ${{ number_format(($item->total_order) ?? 0 , '2', '.', ',') }}
	                      </td>
	                  </tr>
                  @endforeach
                </tbody>
            </table>
            <br>
        @endif

    </body>
</html>