<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

</x-slot>

<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

                    <form method="GET" action="{{ route('getPassanger.get') }}">
                    @csrf
                        <div>

                            <label for="cpf">CPF:</label>
                            <input type="text" id="cpf" name="cpf" class="@error('cpf') is-invalid @enderror" maxlength="14"
                            value="{{ old('cpf') }}"
                            >
        
                            <label for="ticket-id">Ticket ID:</label>
                            <input type="text" id="ticket" name="ticket"
                            value="{{ old('ticket') }}"
                            >


                            @error('cpf')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>

                        </div>
                        <input type="submit" value="Submit" class="btn btn-success">
                    </form>

@isset($search)
    {{$search}}
@endisset

@isset($data)
    <table class="table table-bordered table-striped" id="datatable-default" style="padding: 20px;">
        <thead>
            <tr>
                <th>Parceiro</th>
                <th>Destino</th>
                <th>Data de vigência</th>
                <th>CPF</th>
                <th>Ticket</th>
                <th>Status</th>
                <th>Link</th>
            </tr>
        </thead>
@foreach ($data as $data)    
        <tbody style="padding: 20px;">
            <tr class="gradeX">
                <td><center>{{$data['partner']['name']}}</center></td>
                <td><center>{{$data['destiny_group']['name']}}</center></td>
                <td><center>{{$data['departure']}} / {{$data['arrival']}} </center></td>
                <td><center>{{$data['cpf']}}</center></td>
                <td><center>{{$data['ticket']}}</center></td>
                <td><center>{!!$data['status']!!}</center></td>
                <td><center>{!!$data['pdf']!!}</center></td>
            </tr>
        </tbody>
@endforeach        
    </table>
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
