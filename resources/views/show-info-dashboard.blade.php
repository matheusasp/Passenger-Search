<x-app-layout>
<x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>

</x-slot>

<div class="">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 p-5">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg pt-3 mb-5">

                    
                    <form method="GET" action="{{ route('show.info.list-dashboard') }}" class="mb-5">
                        @csrf
                        <div class="mb-3">
                        <label for="partner" class="form-label">Selecione o parceiro</label>
                        <select name="partner" class="form-control form-control-lg @error('partner') is-invalid @enderror" required autofocus>
                            <option>Selecione</option>
                            @isset($partners)
                                @foreach ($partners as $partner)
                                    <option value="{{$partner->id}}" @if(old('partner')==$partner->id) selected @endif>{{$partner->name}}</option>
                                @endforeach
                            @endisset
                            
                        </select>
                        @error('partner')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="kt-portlet__foot">
                        <div class="kt-form__actions">
                            <button type="submit" class="btn btn-primary" >Selecionar</button>
                        </div>
                    </div>
                       
                    </form>

                    @isset($search)
                    <div class="container">
                        <div class="alert alert-info" role="alert">
                        {{$search}}
                        </div>
                    </div>
                    @endisset
                    @isset($dashboardData)
                    <div class="container">
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
                        @foreach ($dashboardData['data'] as $data)    
                        
                            <tbody style="padding: 20px;">
                                <tr class="gradeX">
                                    <td style="vertical-align: middle"><center>{{$data['partner']['name']}}</center></td>
                                    <td style="vertical-align: middle"><center>{{$data['destiny_group']['name']}}</center></td>
                                    <td style="vertical-align: middle"><center>{{$data['departure']}} / {{$data['arrival']}} </center></td>
                                    <td style="vertical-align: middle"><center>{{$data['cpf']}}</center></td>
                                    <td style="vertical-align: middle"><center>{{$data['ticket']}}</center></td>
                                    @if(Carbon\Carbon::now()->toDateString() > $data['arrival'] && $data['status'] == 'ATIVO')
                                    <td style="vertical-align: middle"><center>{!!$data['status']!!}</center></td>
                                    @else
                                    <td style="vertical-align: middle"><center>{!!$data['status']!!}</center></td>
                                    @endif
                                    <td style="vertical-align: middle"><center>{!!$data['pdf']!!}</center></td>
                                </tr>
                            </tbody>
                        @endforeach        
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
