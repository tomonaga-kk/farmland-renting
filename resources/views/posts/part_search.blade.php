<div class="row mb-3">
  <label for="" class="col-form-label">区画面積[㎡]</label>

    <div class="d-flex justify-content-between align-items-center">
      <input id="size_of_area_min" type="number" class="form-control @error('size_of_area_min') is-invalid @enderror" name="size_of_area_min" placeholder="最小" value="{{in_array("send", $params) ? $params['size_of_area_min'] : null}}">
      <p class="m-0">&nbsp;～&nbsp;</p>
      <input id="size_of_area_max" type="number" class="form-control @error('size_of_area_max') is-invalid @enderror" name="size_of_area_max" placeholder="最大" value="{{in_array("send", $params) ? $params['size_of_area_max'] : null}}">
    </div>
    @error('size_of_area_min')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    @error('size_of_area_max')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>

<div class="row mb-3">
    <label for="" class="col-form-label">月額料金[円]</label>

    <div class="d-flex justify-content-between align-items-center">
      <input id="price_by_month_min" type="number" class="form-control @error('price_by_month_min') is-invalid @enderror" name="price_by_month_min" placeholder="最小" value="{{in_array("send", $params) ? $params['price_by_month_min'] : null}}">
      <p class="m-0">&nbsp;～&nbsp;</p>
      <input id="price_by_month_max" type="number" class="form-control @error('price_by_month_max') is-invalid @enderror" name="price_by_month_max" placeholder="最大" value="{{in_array("send", $params) ? $params['price_by_month_max'] : null}}">
    </div>
    @error('price_by_month_min')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
    @error('price_by_month_max')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
    @enderror
</div>