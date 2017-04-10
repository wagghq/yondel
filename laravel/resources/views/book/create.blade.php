@extends('layout.app')

@section('content')
  <div class="row align-center">
    <div class="columns">
      <section>
        <header>
          <h2>Add a book</h2>
        </header>
      </section>
      <form action="{{ route('book.store') }}" method="POST">
        {{ csrf_field() }}
        <label>
          Enter the book’s URL on amazon.co.jp
          <div class="input-group">
            <input type="url" name="amazon_url" id="amazon-url-input" required="required" value="{{ old('amazon_url') }}" />
            <div class="input-group-button">
              <button type="button" class="button" id="amazon-url-button">Fetch book info</button>
            </div>
          </div>
          <p class="hide" id="amazon-api-result__error">Failed to fetch the information. <a href="#" id="amazon-api-retry">Retry</a></p>
        </label>
        <div class="card hide" id="amazon-api-result">
          <div class="card-divider" id="amazon-api-result__asin"></div>
          <div class="card-section" id="amazon-api-result__title"></div>
          <input id="title" type="hidden" name="title" />
          <input id="asin" type="hidden" name="asin" />
        </div>
        <label>
          Recommendation comment
          <textarea name="recommendation_comment" required="required"></textarea>
        </label>
        <button type="submit" class="button">Add</button>
      </form>
    </div>
  </div>
@endsection

@section('script')
  $amazonUrlInput = $('#amazon-url-input');
  $amazonUrlButton = $('#amazon-url-button');
  $amazonApiResult = $('#amazon-api-result');
  $amazonApiResultAsin = $('#amazon-api-result__asin');
  $amazonApiResultTitle = $('#amazon-api-result__title');
  $amazonApiResultError = $('#amazon-api-result__error');
  $amazonApiRetry = $('#amazon-api-retry');
  $titleInput = $('#title');
  $asinInput = $('#asin');

  function fetchItemInfo() {
    $.ajax({
      url: '{{ route('api.amazon.advertising.lookup') }}',
      data: {
        amazon_url: $amazonUrlInput.val()
      }
    }).done(function (data) {
      $titleInput.val(data.title);
      $asinInput.val(data.asin);
      $amazonApiResultAsin.text(data.asin);
      $amazonApiResultTitle.text(data.title);
      $amazonApiResult.removeClass('hide');
      $amazonApiResultError.addClass('hide');
    }).fail(function () {
      $amazonApiResult.addClass('hide');
      $amazonApiResultError.removeClass('hide');
    });
  }

  $amazonUrlButton.on('click', fetchItemInfo);
  $amazonApiRetry.on('click', fetchItemInfo);


@endsection

