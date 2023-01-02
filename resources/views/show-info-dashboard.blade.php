<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard-panel') }}
        </h2>

</x-slot>

<div class="">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-5">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pt-3 mb-5">
                    @isset($search)
                    <div class="container">
                        <div class="alert alert-info" role="alert">
                        {{$search}}
                        </div>
                    </div>
                    @endisset
                    @isset($dataOrganized)
                    <div class="container">
                        <table class="table table-bordered table-striped" id="datatable-default" style="padding: 20px;">
                            <thead>
                                <tr>
                                    <th>Destino</th>
                                    <th>{{$currentMonth}}</th>
                                    <th>{{$nextMonth}}</th>
                                </tr>
                            </thead>
                            <tbody style="padding: 20px;">
                            @foreach($dataOrganized['currentMonth'] as $key => $value)
                                    <tr>
                                        <td>{{ $key }}</td>
                                        <td>{{ $value }}</td>
                                        <td> @if(isset($dataOrganized['nextMonth'][$key]))
                                            {{ $dataOrganized['nextMonth'][$key] }}
                                            @endif </td>
                                    </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    @endisset    
            </div>
        </div>
    </div>
</x-app-layout>





<script type="text/javascript">

</script>



<script>

document.querySelectorAll('#cpf')[0].addEventListener('keyup', function() {
    if (this.value.length > 0) {
        return document.querySelectorAll('#ticket')[0].disabled = true;
    }
    return document.querySelectorAll('#ticket')[0].disabled = false;
});

document.querySelectorAll('#ticket')[0].addEventListener('keyup', function() {
    if (this.value.length > 0) {
        return document.querySelectorAll('#cpf')[0].disabled = true;
    }
    return document.querySelectorAll('#cpf')[0].disabled = false;
});


</script>
