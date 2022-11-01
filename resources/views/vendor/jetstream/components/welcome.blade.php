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
                        <br>
                        <input type="submit" value="Submit" class="btn btn-success">
                    </form>


@isset($search)
    {{$search}}
@endisset

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

var teste = '';
if(document.querySelectorAll('#cpf')[0].value){

}

document.querySelectorAll('#cpf')[0].addEventListener('keypress', function() {
    let inputLength = this.value.length;

    if (inputLength == 3 || inputLength == 7) {
        this.value += '.'
    }else if (inputLength == 11) {
        this.value += '-'
    } 
}); 

</script>