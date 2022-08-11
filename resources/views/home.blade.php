@extends('layouts.app')

@section('content')
<div class="login-box">
    <a href="#" class="text-center">
        <img src="{{asset('backend/file/images/logo.png')}}" width="250" height="auto"  style="left:15%; position:relative">
    </a>
    <div class="card mt-2">
    <div class="card-body login-card-body">
        <h5 class="text-black text-center">Apply Lamaran</h5>
        @if(\Session::has('alert'))
            <div class="alert alert-danger">
            <div>{{Session::get('alert')}}</div>
            </div>
        @endif
        <form action="" id="formTambahData" method="post" enctype="multipart/form-data">
        @csrf
            <div class="form-group mb-3">
                <label for="">Jabatan</label>
                <select name="job" id="job" class="form-control">
                    <option value="" selected disabled>Pilih Jabatan<option>
                </select>
                <span class="text-danger" id="job-message"></span>
            </div>
            <div class="form-group mb-3">
                <label for="">Nama</label>
                <input type="text" name="name" id="name" class="form-control">
                <span class="text-danger" id="name-message"></span>
            </div>
            <div class="form-group mb-3">
                <label for="">Telepon</label>
                <input type="text" name="phone" id="phone" class="form-control">
                <span class="text-danger" id="phone-message"></span>
            </div>
            <div class="form-group mb-3">
                <label for="">Email</label>
                <input type="text" name="email" id="email" class="form-control">
                <span class="text-danger" id="email-message"></span>
            </div>
            <div class="form-group mb-3">
                <label for="">Tahun Lahir</label>
                <input type="year" name="year" id="year" class="form-control">
                <span class="text-danger" id="year-message"></span>
            </div>
            <div class="form-group mb-3">
                <label for="">Skill Set</label>
                <select name="skill_set[]" id="skill_set" class="form-control text-black" multiple="multiple">

                </select>
                <span class="text-danger" id="skill_set-message"></span>
            </div>
            <div class="row">
            <!-- /.col -->
            <div class="col-12">
                <button type="submit" class="btn btn-danger btn-block" id="btn-apply">Apply</button>
            </div>
            <!-- /.col -->
            </div>
        </form>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
@endsection

@section('footer')
<script>
    $(document).ready(function(){
        let CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $( "#job" ).select2({
            ajax: { 
            url: "{{route('getJob')}}",
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                _token: CSRF_TOKEN,
                search: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                results: response
                };
            },
            cache: true
            }

        });
        $( "#skill_set" ).select2({
            ajax: { 
            url: "{{route('getSkill')}}",
            type: "post",
            dataType: 'json',
            delay: 250,
            data: function (params) {
                return {
                _token: CSRF_TOKEN,
                search: params.term // search term
                };
            },
            processResults: function (response) {
                return {
                results: response
                };
            },
            cache: true
            }

        });

        $('#btn-apply').click(function(e){
            e.preventDefault();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                url: "{{ route('storeCandidate') }}",
                method: "POST",
                data: $('#formTambahData').serialize(),
                success: function(result) {
                    if (result.messages) {
                        if(result.messages.job){
                            $('#job-message').text(result.messages.job);
                            $('#job').addClass('is-invalid');
                        }else{
                            $('#job-message').text('');
                            $('#job').removeClass('is-invalid');
                        }
                        if(result.messages.name){
                            $('#name-message').text(result.messages.name);
                            $('#name').addClass('is-invalid');
                        }else{
                            $('#name').removeClass('is-invalid');
                            $('#name-message').text('');
                        }
                        if(result.messages.email){
                            $('#email-message').text(result.messages.email);
                            $('#email').addClass('is-invalid');
                        }else{
                            $('#email').removeClass('is-invalid');
                            $('#email-message').text('');
                        }
                        if(result.messages.phone){
                            $('#phone-message').text(result.messages.phone);
                            $('#phone').addClass('is-invalid');
                        }else{
                            $('#phone').removeClass('is-invalid');
                            $('#phone-message').text('');
                        }
                        if(result.messages.year){
                            $('#year-message').text(result.messages.year);
                            $('#year').addClass('is-invalid');
                        }else{
                            $('#year').removeClass('is-invalid');
                            $('#year-message').text('');
                        }
                        if(result.messages.skill_set){
                            $('#skill_set-message').text(result.messages.skill_set);
                            $('#skill_set').addClass('is-invalid');
                        }else{
                            $('#skill_set').removeClass('is-invalid');
                            $('#skill_set-message').text('');
                        }

                        Swal.fire({
                            title:'Terjadi Kesalahan!',
                            text: (result.messages.job ? result.messages.job+', ' : '')
                            +(result.messages.name ? result.messages.name+', ' : '')
                            +(result.messages.email ? result.messages.email+', ' : '')
                            +(result.messages.phone ? result.messages.phone+', ' : '')
                            +(result.messages.year ? result.messages.year+', ' : '')
                            +(result.messages.skill_set ? result.messages.skill_set : ''),
                            confirmButtonText: 'Baiklah',
                            confirmButtonColor: '#F64E60',
                            icon:'error'
                        })
                    } else {
                        $('.alert-danger').hide();
                        $('.alert-success').show();
                        $('.datatable').DataTable().ajax.reload();
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: 'Lamaran Berhasil Dikirim',
                            confirmButtonText: 'Selesai',
                            confirmButtonColor: '#1BC5BD'
                        })
                        $('.alert-success').hide();
                    }
                },
                error: function(response) {
                    $.each(response.responseJSON.errors, function(kode_brg, error) {
                        $(document).find('[name=' + kode_brg + ']').after(
                            '<span class="text-strong text-danger">' + error +
                            '</span>')
                    })
                }
            });
        });
    });
</script>
@stop