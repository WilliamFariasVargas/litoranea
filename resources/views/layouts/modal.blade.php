
<link rel="stylesheet" href="{{asset('assets/css/modal.css')}}?id={{rand()}}">
<form id="create_edit"  enctype="multipart/form-data">
    @csrf
    <div class="modal fade" id="mainMTIModal"  aria-labelledby="modalPage" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalPage">@yield("modal_title")</h1>
                    <button type="button" class="btn btn-dark" data-bs-dismiss="modal" aria-label="Close" id="closeModal"><i class="fa fa-times"></i></button>
                </div>
                <div class="modal-body  p-4">
                    <section class="row">
                        @yield("modal_content")
                    </section>
                </div>
                <div class="modal-footer">
                    @hasSection('modal_footer')
                        @yield('modal_footer')
                    @else
                        <button type="submit" class="btn btn-success">Salvar</button>
                    @endif
                </div>

            </div>
        </div>
    </div>
</form>
