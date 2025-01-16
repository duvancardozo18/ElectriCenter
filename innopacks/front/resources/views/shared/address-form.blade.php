<form class="needs-validation address-form mb-4" novalidate>
  <input type="hidden" name="id" value="">

  @if(current_customer_id())
  <div class="form-group mb-4">
    <label class="form-label" for="name">{{ __('common/address.name') }}</label>
    <input type="text" class="form-control" name="name" value="" required
      placeholder="{{ __('common/address.name') }}" />
    <span class="invalid-feedback" role="alert">{{ __('front/common.error_required', ['name' =>
      __('common/address.name')]) }}</span>
  </div>
  @else
  <div class="row gx-2">
    <div class="col-6">
      <div class="form-group mb-4">
        <label class="form-label" for="name">{{ __('common/address.name') }}</label>
        <input type="text" class="form-control" name="name" value="" required
          placeholder="" />
        <span class="invalid-feedback" role="alert">{{ __('front/common.error_required', ['name' =>
          __('common/address.name')]) }}</span>
      </div>
    </div>
    <div class="col-6">
      <div class="form-group mb-4">
        <label class="form-label" for="email">{{ __('common/address.email') }}</label>
        <input type="text" class="form-control" name="email" value="" required
          placeholder="" />
        <span class="invalid-feedback" role="alert">{{ __('front/common.error_required', ['name' =>
          __('common/address.email')]) }}</span>
      </div>
    </div>
  </div>
  @endif

  
  <div class="row gx-2">
    <div class="col-6">
      <div class="form-group mb-4">
        <label class="form-label" for="country_code">Departamento</label>
        <select class="form-select" name="state_code" required></select>
        <span class="invalid-feedback" role="alert">{{ __('front/common.error_required', ['name' =>
          __('common/address.country')]) }}</span>
      </div>
    </div>

    <div class="col-6">
      <div class="form-group mb-4">
        <label class="form-label" for="state">Municipio</label>
        <select class="form-select" name="cities_code" required disabled></select>
        <span class="invalid-feedback" role="alert">{{ __('front/common.error_required', ['name' =>
          __('common/address.state')]) }}</span>
      </div>
    </div>
</div>


  <div class="row gx-2">
   {{--  <div class="col-6">
      <div class="form-group mb-4">
        <label class="form-label" for="Address_1">{{ __('common/address.address_2') }}</label>
        <input type="text" class="form-control" name="address_2" value=""
          placeholder="{{ __('common/address.address_2') }}" />
      </div>
    </div> --}}

{{--     <div class="col-6">
      <div class="form-group mb-4">
        <label class="form-label" for="zipcode">{{ __('common/address.zipcode') }}</label>
        <input type="text" class="form-control" name="zipcode" value="" required
          placeholder="{{ __('common/address.zipcode') }}" />
        <span class="invalid-feedback" role="alert">{{ __('front/common.error_required', ['name' =>
          __('common/address.zipcode')]) }}</span>
      </div>
    </div> --}}
    {{-- <div class="col-6">
      <div class="form-group mb-4">
        <label class="form-label" for="city">{{ __('common/address.city') }}</label>
        <input type="text" class="form-control" name="city" value="" required placeholder="" />
        <span class="invalid-feedback" role="alert">{{ __('front/common.error_required', ['name' =>
          __('common/address.city')]) }}</span>
      </div>
    </div> --}}


    {{-- <div class="col-6">
      <div class="form-group mb-4">
        <label class="form-label" for="country_code">{{ __('common/address.country') }}</label>
        <select class="form-select" name="country_code" required></select>
        <span class="invalid-feedback" role="alert">{{ __('front/common.error_required', ['name' =>
          __('common/address.country')]) }}</span>
      </div>
    </div> --}}

    <div class="col-6">
    <div class="form-group mb-4">
      <label class="form-label" for="email">{{ __('common/address.address_1') }}</label>
      <input type="text" class="form-control" name="address_1" value="" required
        placeholder="" />
      <span class="invalid-feedback" role="alert">{{ __('front/common.error_required', ['name' =>
        __('common/address.address_1')]) }}</span>
    </div>
  </div>

   <div class="col-6">
      <div class="form-group mb-4">
        <label class="form-label" for="phone">{{ __('common/address.phone') }}</label>
        <input type="text" class="form-control" name="phone" value="" placeholder="" />
      </div>
    </div>

  </div>

  <div class="col-6">
    <div class="form-group mb-4 d-flex gap-3">
         <label class="form-label" for="default">{{__('front/common.default')}}</label>
        <div class="form-check form-switch">
        <input class="form-check-input" type="checkbox" role="switch" id="default" name="default" value="1">
      </div>
    </div>
  </div>


  
  <div class="checkout-item">
    <div class="title-wrap">
      <div class="title">{{ __('front/checkout.shipping_methods') }}</div>
    </div>
    <div class="checkout-select-wrap">
      <div v-for="item in source.shippingMethods" :key="item.code">
        <div v-for="quote in item.quotes" :key="quote.code" @click="updateCheckout('shipping_method_code', quote.code)"
             :class="['select-item', current.shipping_method_code  == quote.code ? 'active' : '']">
          <div class="left">
            <i class="bi bi-circle"></i>
            <div class="select-title">
              <span class="name"> @{{ quote.name }}</span> &nbsp;&nbsp;
              <span class="cost"> @{{ quote.cost_format }}</span>
            </div>
          </div>
          <div class="icon"><img :src="quote.icon" class="img-fluid"></div>
        </div>
      </div>
      <div v-if="!source.shippingMethods.length" class="alert alert-warning">
        <i class="bi bi-exclamation-circle-fill"></i> {{ __('front/checkout.no_shipping_methods') }}</div>
    </div>
  </div>

 {{--  Metodos de pago y envio  --}}
  <div class="checkout-item">
    <div class="title-wrap">
      <div class="title">{{ __('front/checkout.billing_methods') }}</div>
    </div>
    <div class="checkout-select-wrap">
      <div :class="['select-item', current.billing_method_code  == item.code ? 'active' : '']"
           v-for="item in source.billingMethods" :key="item.code"
           @click="updateCheckout('billing_method_code', item.code)">
        <div class="left">
          <i class="bi bi-circle"></i>
          <div class="select-title">@{{ item.name }}</div>
        </div>
        <div class="icon"><img :src="item.icon" class="img-fluid"></div>
      </div>
      <div v-if="!source.billingMethods.length" class="alert alert-warning"><i class="bi bi-exclamation-circle-fill"></i> {{ __('front/checkout.no_billing_methods') }}</div>
    </div>
  </div>


  <div class="d-flex justify-content-center">
    <button type="button" class="btn btn-primary btn-lg form-submit w-50">{{ __('front/common.submit') }}</button>
  </div>
</form>

@push('footer')


{{-- <script>
  const settingCountryCode = @json(system_setting('country_code') ?? '');
  const settingStateCode = @json(system_setting('state_code') ?? '');

  inno.validateAndSubmitForm('.address-form', function(data) {
    if (typeof updataAddress === 'function') {
      updataAddress(data);
    }
  });

  getCountries();

  if (settingCountryCode) {
    $('select[name="country_code"]').val(settingCountryCode);
    getZones(settingCountryCode);
  }

  $(document).on('change', 'select[name="country_code"]', function() {
    var countryId = $(this).val();
    getZones(countryId);
  });

  // Obtenga datos de todos los países
  function getCountries() {
    axios.get('{{ front_route('countries.index') }}').then(function(res) {
      var countries = res.data;
      var countrySelect = $('select[name="country_code"]');
      countrySelect.empty();
      countrySelect.append('<option value="">{{ __('front/common.please_choose') }}</option>');
      countries.forEach(function(country) {
        countrySelect.append('<option value="' + country.code + '"' + (country.code == settingCountryCode ? ' selected' : '') + '>' + country.name + '</option>');
      });
    });
  }

  // Obtenga los datos provinciales del país correspondiente
  function getZones(countryId, callback = null) {
    axios.get('{{ front_route('countries.index') }}/' + countryId).then(function(res) {
      var zones = res.data;
      var zoneSelect = $('select[name="state_code"]');
      zoneSelect.empty().prop('disabled', false);
      zoneSelect.append('<option value="">{{ __('front/common.please_choose') }}</option>');
      zones.forEach(function(zone) {
        zoneSelect.append('<option value="' + zone.code + '"' + (zone.code == settingStateCode ? ' selected' : '') + '>' + zone.name + '</option>');
      });

      if (typeof callback === 'function') {
        callback();
      }
    });
  }

  function clearForm() {
    const addressForm = $('.address-form');
    addressForm[0].reset();
    addressForm.removeClass('was-validated');

    addressForm.find('.is-valid, .is-invalid').removeClass('is-valid is-invalid');
  }
</script> --}}

<script>
  document.addEventListener('DOMContentLoaded', function () {
      const stateSelect = document.querySelector('select[name="state_code"]');
      const citySelect = document.querySelector('select[name="cities_code"]');

      // Cargar departamentos al cargar la página
      fetch('/states')
          .then(response => {
              if (!response.ok) {
                  throw new Error('Error loading states');
              }
              return response.json();
          })
          .then(data => {
              // Llenar el select de departamentos
              stateSelect.innerHTML = '<option value="">Seleccione una opción</option>';
              data.forEach(state => {
                  const option = document.createElement('option');
                  option.value = state.code; // Usar el ID como código
                  option.textContent = state.name; // Usar el nombre del departamento
                  stateSelect.appendChild(option);
              });
          })
          .catch(error => {
              console.error('Error fetching states:', error);
              stateSelect.innerHTML = '<option value="">Error loading departments</option>';
          });

      // Evento para cargar los municipios al seleccionar un departamento
      stateSelect.addEventListener('change', function () {
          const stateCode = this.value;

          // Limpia y desactiva el select de ciudades mientras se cargan los datos
          citySelect.innerHTML = '<option value="">Cargando...</option>';
          citySelect.disabled = true;

          if (stateCode) {
              fetch(`/cities/${stateCode}`)
                  .then(response => {
                      if (!response.ok) {
                          throw new Error('Error loading cities');
                      }
                      return response.json();
                  })
                  .then(data => {
                      // Llenar el select de ciudades
                      citySelect.innerHTML = '<option value="">Seleccione una opción</option>';
                      data.forEach(city => {
                          const option = document.createElement('option');
                          option.value = city.name; // Usar el nombre de la ciudad como valor
                          option.textContent = city.name; // Mostrar el nombre de la ciudad
                          citySelect.appendChild(option);
                      });
                      citySelect.disabled = false;
                  })
                  .catch(error => {
                      console.error('Error fetching cities:', error);
                      citySelect.innerHTML = '<option value="">Error loading cities</option>';
                  });
          } else {
              citySelect.innerHTML = '<option value="">Seleccione un departamento primero</option>';
          }
      });
  });
</script>

@endpush