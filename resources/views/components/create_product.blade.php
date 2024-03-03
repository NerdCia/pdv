@extends('components.products')

@section('title', 'Criar novo produto')

@section('modal')

<div class="modal fade" id="createProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
    <div class="modal-content rounded-4 border-0">
      <div class="modal-header">
        <h1 class="modal-title fs-4 fw-bold text-body-emphasis" id="productModalLabel"><i
            class="bi bi-bag fs-2 me-2"></i>Criar novo produto</h1>
        <a type="button" class="btn-close" href="{{ route('components.products') }}"></a>
      </div>
      <div class="modal-body">
        <form action="" method="POST" enctype="multipart/form-data">
          <div class="row mb-3 align-items-center shadow p-2 mx-2 rounded-4">
            <div class="col mb-3 mb-xl-0 text-center">
              <img src="/img/image_missing.jpg" class="img-fluid shadow" alt="">
            </div>
            <div class="col-12 col-xl-8">
              <div class="mb-3">
                <label for="imageFile" class="form-label"><small class="fw-bold text-body-emphasis">Selecione a
                    imagem:</small></label>
                <input class="form-control shadow" type="file" id="imageFile">
              </div>
              <div class="row g-3 mb-3">
                <div class="col-sm-7">
                  <label for="productInputName" class="form-label"><small class="fw-bold text-body-emphasis">Nome do
                      produto:</small></label>
                  <input type="text" class="form-control shadow" name="name" id="productInputName"
                    placeholder="Digite o nome do produto">
                </div>
                <div class="col-sm">
                  <label for="productInputPrice" class="form-label"><small
                      class="fw-bold text-body-emphasis">Preço:</small></label>
                  <input type="number" class="form-control" placeholder="Preço" aria-label="Preço"
                    id="productInputPrice">
                </div>
                <div class="col-sm">
                  <label for="productInputQuantity" class="form-label"><small
                      class="fw-bold text-body-emphasis">Quantidade:</small></label>
                  <input type="number" class="form-control" placeholder="Quantidade" aria-label="Quantidade"
                    id="productInputQuantity">
                </div>
                <div class="mb-3">
                  <label for="productInputDescription" class="form-label"><small
                      class="fw-bold text-body-emphasis">Descrição
                      do
                      produto:</small></label>
                  <textarea type="text" class="form-control shadow" name="name" id="productInputDescription"
                    placeholder="Digite a descrição do produto"></textarea>
                </div>
              </div>
            </div>
            <div class="d-grid gap-2 col-6 mx-auto mb-3">
              <button type="button" class="btn btn-danger rounded-pill">Adicionar</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection