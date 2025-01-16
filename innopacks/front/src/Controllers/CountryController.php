<?php
namespace InnoShop\Front\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use InnoShop\Common\Models\Country;
use InnoShop\Common\Repositories\CountryRepo;
use InnoShop\Common\Repositories\StateRepo;
use InnoShop\Common\Resources\CountrySimple;
use InnoShop\Panel\Controllers\BaseController;
use Illuminate\Support\Facades\Storage;

class CountryController extends BaseController
{
    /**
     * @param  Request  $request
     * @return AnonymousResourceCollection
     */
/*     public function index(Request $request): AnonymousResourceCollection
    {
        $countries = CountryRepo::getInstance()->getCountries($request->all());

        return CountrySimple::collection($countries);
    } */

    /**
     * @param  string  $code
     * @return mixed
     */
/*     public function show(string $code): mixed
    {
        $country = Country::query()->where('code', $code)->orWhere('id', $code)->first();
        if (empty($country)) {
            return collect();
        }

        $filters = [
            'country_id' => $country->id,
        ];
        $countries = StateRepo::getInstance()->builder($filters)->get();

        return CountrySimple::collection($countries);
    }
 */

    //Departamentos y municipios Colombia
    // Ruta del archivo JSON
    private $filePath = 'resources/json/data/locations.json';

    private function loadJsonData()
    {
        $json = file_get_contents(base_path($this->filePath));
        return json_decode($json, true);
    }

    // Método para obtener los departamentos (estados)
    public function getStates()
    {
        $data = $this->loadJsonData();
        $states = array_map(function ($item) {
            return [
                'code' => $item['id'], // Usa "id" como código
                'name' => $item['departamento'], // Usa "departamento" como nombre
            ];
        }, $data);

        return response()->json($states);
    }

    // Método para obtener las ciudades de un departamento
    public function getCities($stateCode)
    {
        $data = $this->loadJsonData();
        $state = collect($data)->firstWhere('id', (int)$stateCode);

        if ($state) {
            $cities = array_map(function ($city) {
                return ['name' => $city];
            }, $state['ciudades']);

            return response()->json($cities);
        }

        return response()->json(['error' => 'State not found'], 404);
    }
}
