@extends('components.products')

@section('title', 'Criar novo produto')

@section('modal')

  <div class="modal fade" id="createProductModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="productModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
      <div class="modal-content rounded-4 border-0">
        <div class="modal-header">
          <h1 class="modal-title fs-4 fw-bold text-body-emphasis" id="productModalLabel"><i
              class="bi bi-bag fs-2 me-2"></i>Criar novo produto</h1>
          <a type="button" class="btn-close" href="{{ route('components.products') }}"></a>
        </div>
        <div class="modal-body">
          <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data" novalidate>
            @method('POST')
            @csrf
            <div class="row mb-3 align-items-center shadow p-2 mx-2 rounded-4">
              <div class="col mb-3 mb-xl-0 text-center">
                <img src="{{ asset('img/image_missing.jpg') }}" class="img-fluid shadow" alt="">
              </div>
              <div class="col-12 col-xl-8">
                <div class="mb-3">
                  <label for="imageFile" class="form-label"><small class="fw-bold text-body-emphasis">Selecione a
                      imagem:</small></label>
                  <input class="form-control shadow {{ count($errors->get('image')) > 0 ? 'is-invalid' : '' }}"
                    type="file" name="image" id="imageFile" aria-describedby="validationServerImageFeedback">
                  @if ($errors->has('image'))
                    @foreach ($errors->get('image') as $message)
                      @include('includes.invalid-feedback', [
                          'id' => 'validationServerImageFeedback',
                          'message' => $message,
                      ])
                    @endforeach
                  @endif
                </div>
                <div class="row g-3 mb-3">
                  <div class="col-sm-8">
                    <label for="productInputName" class="form-label"><small class="fw-bold text-body-emphasis">Nome do
                        produto:</small></label>
                    <input type="text" class="form-control shadow {{ $errors->has('name') ? 'is-invalid' : '' }}"
                      name="name" id="productInputName" aria-describedby="validationServerNameFeedback" placeholder="Digite o nome do produto" required>
                    @if ($errors->has('name'))
                      @foreach ($errors->get('name') as $message)
                        @include('includes.invalid-feedback', [
                            'id' => 'validationServerNameFeedback',
                            'message' => $message,
                        ])
                      @endforeach
                    @endif
                  </div>
                  <div class="col-sm-4">
                    <label for="productInputQuantity" class="form-label"><small
                        class="fw-bold text-body-emphasis">Quantidade:</small></label>
                    <input type="number" class="form-control {{ $errors->has('quantity') ? 'is-invalid' : '' }}"
                      placeholder="Quantidade" aria-label="Quantidade" name="quantity" aria-describedby="validationServerQuantityFeedback" id="productInputQuantity" required>
                    @if ($errors->has('quantity'))
                      @foreach ($errors->get('quantity') as $message)
                        @include('includes.invalid-feedback', [
                            'id' => 'validationServerQuantityFeedback',
                            'message' => $message,
                        ])
                      @endforeach
                    @endif
                  </div>
                  <div class="col-sm">
                    <label for="productInputPrice" class="form-label"><small
                        class="fw-bold text-body-emphasis">Preço:</small></label>
                    <input type="number" step="0.01"
                      class="form-control {{ $errors->has('price') ? 'is-invalid' : '' }}" placeholder="Preço"
                      aria-label="Preço" name="price" aria-describedby="validationServerPriceFeedback" id="productInputPrice" required>
                    @if ($errors->has('price'))
                      @foreach ($errors->get('price') as $message)
                        @include('includes.invalid-feedback', [
                            'id' => 'validationServerPriceFeedback',
                            'message' => $message,
                        ])
                      @endforeach
                    @endif
                  </div>
                  <div class="col-sm">
                    <label for="productInputExpense" class="form-label"><small
                        class="fw-bold text-body-emphasis">Custo:</small></label>
                    <input type="number" step="0.01"
                      class="form-control {{ $errors->has('expense') ? 'is-invalid' : '' }}" placeholder="Custo"
                      aria-label="Custo" name="expense" aria-describedby="validationServerExpenseFeedback" id="productInputExpense" required>
                    @if ($errors->has('expense'))
                      @foreach ($errors->get('expense') as $message)
                        @include('includes.invalid-feedback', [
                            'id' => 'validationServerExpenseFeedback',
                            'message' => $message,
                        ])
                      @endforeach
                    @endif
                  </div>
                  <div class="col-sm-12">
                    <label for="categorySelect" class="form-label"><small
                        class="fw-bold text-body-emphasis">Categoria:</small></label>
                    <select class="form-select {{ $errors->has('id_category') ? 'is-invalid' : '' }}"
                      aria-label="Categorias" name="id_category" aria-describedby="validationServerCategoryFeedback" id="categorySelect">
                      <option value="1" selected>raiz</option>
                      @forelse ($categories as $category)
                        @if ($category->name != 'raiz')
                          <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endif
                      @empty
                      @endforelse
                    </select>
                    @if ($errors->has('id_category'))
                      @foreach ($errors->get('id_category') as $message)
                        @include('includes.invalid-feedback', [
                            'id' => 'validationServerCategoryFeedback',
                            'message' => $message,
                        ])
                      @endforeach
                    @endif
                  </div>
                  <div class="mb-3">
                    <label for="productInputDescription" class="form-label"><small
                        class="fw-bold text-body-emphasis">Descrição
                        do
                        produto:</small></label>
                    <textarea type="text" class="form-control shadow {{ $errors->has('description') ? 'is-invalid' : '' }}"
                      name="description" aria-describedby="validationServerDescriptionFeedback" id="productInputDescription" placeholder="Digite a descrição do produto"></textarea>
                    @if ($errors->has('description'))
                      @foreach ($errors->get('description') as $message)
                        @include('includes.invalid-feedback', [
                            'id' => 'validationServerDescriptionFeedback',
                            'message' => $message,
                        ])
                      @endforeach
                    @endif
                  </div>
                </div>
              </div>
              <div class="d-grid gap-2 col-6 mx-auto mb-3">
                <button type="submit" class="btn btn-danger rounded-pill">Adicionar</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>

@endsection
