# Geocoding API
La geocodificación (directa) permite obtener las coordenadas geográficas a partir
de una dirección conocida.
Por ejemplo la siguiente petición:
<https://maps.googleapis.com/maps/api/goecode/json?adress=27+Paseo+Limonar,+Málaga,+Andalucía&key=AIzaSyAy5jl21kgBW_jlmfqxS91inIK12QVvVh3RJc>

Nos devuelve el json siguiente

{
   "resultados": [
      {
         "address_components": [
            {
               "long_name": "27",
               "nombre_corto": "27",
               "tipos": ["street_number"]
            },
            {
               "long_name": "Paseo Limonar",
               "nombre_corto": "Paseo Limonar",
               "tipos": ["ruta"]
            },
            {
               "long_name": "Málaga",
               "nombre_corto": "Málaga",
               "tipos": ["localidad", "política"]
            },
            {
               "long_name": "Málaga",
               "nombre_corto": "Málaga",
               "tipos": ["nivel_área_administrativa_2", "político"]
            },
            {
               "long_name": "Andalucía",
               "nombre_corto": "AL",
               "tipos": ["nivel_área_administrativo_1", "político"]
            },
            {
               "long_name": "España",
               "nombre_corto": "ES",
               "tipos": ["país", "político"]
            },
            {
               "long_name": "29016",
               "nombre_corto": "29016",
               "tipos": ["código_ postal"]
            }
         ],
         "formatted_address": "Paseo Limonar, 27, 29016 Málaga, España",
         "geometría": {
            "ubicación" : {
               "lat": 36.7269744,
               "lng": -4.3985728
            },
            "location_type": "TECHO",
            "vista": {
               "Noreste" : {
                  "lat": 36.7283233802915,
                  "lng": -4.397223819708498
               },
               "Sur oeste" : {
                  "lat": 36.7256254197085,
                  "lng": -4.399921780291502
               }
            }
         },
         "place_id": "ChIJ0VAWRN_3cg0RTFggE02PMuI",
         "plus_code": {
            "compuesto_código": "PJG2 + QH Málaga, España",
            "global_code": "8C8QPJG2 + QH"
         },
         "tipos": ["street_address"]
      }
   ],
   "estado": "OK"
}

La geocodificación (inversa) permite obtener una dirección a partir de las coordenadas geográficas.
Por ejemplo la siguiente petición:
<https://maps.googleapis.com/maps/api/geocode/json?latlng=36.7269744,-4.3985728&key=AIzaSyAy5jl21kgBW_jlmfqxS91inIK12QVvVh3RJc>

Nos devuelve el json siguiente (comentario: más difuso que el anterior)

{
   "plus_code" : {
      "compound_code" : "PJG2+QH Málaga, España",
      "global_code" : "8C8QPJG2+QH"
   },
   "results" : [
      {
         "address_components" : [
            {
               "long_name" : "27",
               "short_name" : "27",
               "types" : [ "street_number" ]
            },
            {
               "long_name" : "Paseo Limonar",
               "short_name" : "Paseo Limonar",
               "types" : [ "route" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "locality", "political" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            },
            {
               "long_name" : "29016",
               "short_name" : "29016",
               "types" : [ "postal_code" ]
            }
         ],
         "formatted_address" : "Paseo Limonar, 27, 29016 Málaga, España",
         "geometry" : {
            "location" : {
               "lat" : 36.7269766,
               "lng" : -4.398585499999999
            },
            "location_type" : "ROOFTOP",
            "viewport" : {
               "northeast" : {
                  "lat" : 36.7283255802915,
                  "lng" : -4.397236519708497
               },
               "southwest" : {
                  "lat" : 36.7256276197085,
                  "lng" : -4.399934480291502
               }
            }
         },
         "place_id" : "ChIJXzhoRN_3cg0R_0A_2UMXNFQ",
         "plus_code" : {
            "compound_code" : "PJG2+QH Málaga, España",
            "global_code" : "8C8QPJG2+QH"
         },
         "types" : [ "establishment", "lawyer", "point_of_interest" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "27",
               "short_name" : "27",
               "types" : [ "street_number" ]
            },
            {
               "long_name" : "Paseo Limonar",
               "short_name" : "Paseo Limonar",
               "types" : [ "route" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "locality", "political" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            },
            {
               "long_name" : "29016",
               "short_name" : "29016",
               "types" : [ "postal_code" ]
            }
         ],
         "formatted_address" : "Paseo Limonar, 27, 29016 Málaga, España",
         "geometry" : {
            "location" : {
               "lat" : 36.7269744,
               "lng" : -4.3985728
            },
            "location_type" : "ROOFTOP",
            "viewport" : {
               "northeast" : {
                  "lat" : 36.7283233802915,
                  "lng" : -4.397223819708498
               },
               "southwest" : {
                  "lat" : 36.7256254197085,
                  "lng" : -4.399921780291502
               }
            }
         },
         "place_id" : "ChIJ0VAWRN_3cg0RTFggE02PMuI",
         "plus_code" : {
            "compound_code" : "PJG2+QH Málaga, España",
            "global_code" : "8C8QPJG2+QH"
         },
         "types" : [ "street_address" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "Limonar (Ramos Carrion)",
               "short_name" : "Limonar (Ramos Carrion)",
               "types" : [ "establishment", "point_of_interest", "transit_station" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "locality", "political" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            },
            {
               "long_name" : "29016",
               "short_name" : "29016",
               "types" : [ "postal_code" ]
            }
         ],
         "formatted_address" : "Limonar (Ramos Carrion), 29016 Málaga, España",
         "geometry" : {
            "location" : {
               "lat" : 36.726679,
               "lng" : -4.398556
            },
            "location_type" : "GEOMETRIC_CENTER",
            "viewport" : {
               "northeast" : {
                  "lat" : 36.72802798029149,
                  "lng" : -4.397207019708498
               },
               "southwest" : {
                  "lat" : 36.7253300197085,
                  "lng" : -4.399904980291502
               }
            }
         },
         "place_id" : "ChIJh-zNQ9_3cg0R3IeculmlD1M",
         "plus_code" : {
            "compound_code" : "PJG2+MH Málaga, España",
            "global_code" : "8C8QPJG2+MH"
         },
         "types" : [ "establishment", "point_of_interest", "transit_station" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "27",
               "short_name" : "27",
               "types" : [ "street_number" ]
            },
            {
               "long_name" : "Paseo Limonar",
               "short_name" : "Paseo Limonar",
               "types" : [ "route" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "locality", "political" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            },
            {
               "long_name" : "29016",
               "short_name" : "29016",
               "types" : [ "postal_code" ]
            }
         ],
         "formatted_address" : "Paseo Limonar, 27, 29016 Málaga, España",
         "geometry" : {
            "location" : {
               "lat" : 36.7269647,
               "lng" : -4.398450200000001
            },
            "location_type" : "RANGE_INTERPOLATED",
            "viewport" : {
               "northeast" : {
                  "lat" : 36.72831368029149,
                  "lng" : -4.397101219708499
               },
               "southwest" : {
                  "lat" : 36.72561571970849,
                  "lng" : -4.399799180291503
               }
            }
         },
         "place_id" : "EidQYXNlbyBMaW1vbmFyLCAyNywgMjkwMTYgTcOhbGFnYSwgU3BhaW4iGhIYChQKEgndTLtD3_dyDRHJVW_qY1HygxAb",
         "types" : [ "street_address" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "28-32",
               "short_name" : "28-32",
               "types" : [ "street_number" ]
            },
            {
               "long_name" : "Paseo Limonar",
               "short_name" : "Paseo Limonar",
               "types" : [ "route" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "locality", "political" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            },
            {
               "long_name" : "29016",
               "short_name" : "29016",
               "types" : [ "postal_code" ]
            }
         ],
         "formatted_address" : "Paseo Limonar, 28-32, 29016 Málaga, España",
         "geometry" : {
            "bounds" : {
               "northeast" : {
                  "lat" : 36.7270957,
                  "lng" : -4.3984341
               },
               "southwest" : {
                  "lat" : 36.7263544,
                  "lng" : -4.3985251
               }
            },
            "location" : {
               "lat" : 36.7267251,
               "lng" : -4.3984796
            },
            "location_type" : "GEOMETRIC_CENTER",
            "viewport" : {
               "northeast" : {
                  "lat" : 36.7280740302915,
                  "lng" : -4.397130619708498
               },
               "southwest" : {
                  "lat" : 36.7253760697085,
                  "lng" : -4.399828580291502
               }
            }
         },
         "place_id" : "ChIJ3Uy7Q9_3cg0RyFVv6mNR8oM",
         "types" : [ "route" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "El Limonar",
               "short_name" : "El Limonar",
               "types" : [ "neighborhood", "political" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "locality", "political" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            },
            {
               "long_name" : "29016",
               "short_name" : "29016",
               "types" : [ "postal_code" ]
            }
         ],
         "formatted_address" : "El Limonar, 29016 Málaga, España",
         "geometry" : {
            "bounds" : {
               "northeast" : {
                  "lat" : 36.7296068,
                  "lng" : -4.397352199999999
               },
               "southwest" : {
                  "lat" : 36.722492,
                  "lng" : -4.4007591
               }
            },
            "location" : {
               "lat" : 36.7271772,
               "lng" : -4.3982785
            },
            "location_type" : "APPROXIMATE",
            "viewport" : {
               "northeast" : {
                  "lat" : 36.7296068,
                  "lng" : -4.397352199999999
               },
               "southwest" : {
                  "lat" : 36.722492,
                  "lng" : -4.4007591
               }
            }
         },
         "place_id" : "ChIJ4esME9_3cg0RmlC8oNPSk9Q",
         "types" : [ "neighborhood", "political" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "29016",
               "short_name" : "29016",
               "types" : [ "postal_code" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "locality", "political" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            }
         ],
         "formatted_address" : "29016 Málaga, España",
         "geometry" : {
            "bounds" : {
               "northeast" : {
                  "lat" : 36.7399338,
                  "lng" : -4.3855828
               },
               "southwest" : {
                  "lat" : 36.7069848,
                  "lng" : -4.4172038
               }
            },
            "location" : {
               "lat" : 36.7250886,
               "lng" : -4.4002069
            },
            "location_type" : "APPROXIMATE",
            "viewport" : {
               "northeast" : {
                  "lat" : 36.7399338,
                  "lng" : -4.3855828
               },
               "southwest" : {
                  "lat" : 36.7069848,
                  "lng" : -4.4172038
               }
            }
         },
         "place_id" : "ChIJV7Snvt73cg0RcEd94XvSAxw",
         "types" : [ "postal_code" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "locality", "political" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            }
         ],
         "formatted_address" : "Málaga, España",
         "geometry" : {
            "bounds" : {
               "northeast" : {
                  "lat" : 36.7575526,
                  "lng" : -4.3394965
               },
               "southwest" : {
                  "lat" : 36.6788914,
                  "lng" : -4.5590373
               }
            },
            "location" : {
               "lat" : 36.721261,
               "lng" : -4.4212655
            },
            "location_type" : "APPROXIMATE",
            "viewport" : {
               "northeast" : {
                  "lat" : 36.7575526,
                  "lng" : -4.3394965
               },
               "southwest" : {
                  "lat" : 36.6788914,
                  "lng" : -4.5590373
               }
            }
         },
         "place_id" : "ChIJLSHbT8RZcg0RzzLKyZLcJWA",
         "types" : [ "locality", "political" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "Málaga-Este",
               "short_name" : "Málaga-Este",
               "types" : [ "political", "sublocality", "sublocality_level_1" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "locality", "political" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            }
         ],
         "formatted_address" : "Málaga-Este, Málaga, España",
         "geometry" : {
            "bounds" : {
               "northeast" : {
                  "lat" : 36.80316200000001,
                  "lng" : -4.2931418
               },
               "southwest" : {
                  "lat" : 36.7114719,
                  "lng" : -4.4146192
               }
            },
            "location" : {
               "lat" : 36.7566511,
               "lng" : -4.346237299999999
            },
            "location_type" : "APPROXIMATE",
            "viewport" : {
               "northeast" : {
                  "lat" : 36.80316200000001,
                  "lng" : -4.2931418
               },
               "southwest" : {
                  "lat" : 36.7114719,
                  "lng" : -4.4146192
               }
            }
         },
         "place_id" : "ChIJq7O-2BxZcg0RRponUP3BC9M",
         "types" : [ "political", "sublocality", "sublocality_level_1" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_4", "political" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            }
         ],
         "formatted_address" : "Málaga, España",
         "geometry" : {
            "bounds" : {
               "northeast" : {
                  "lat" : 36.8940412,
                  "lng" : -4.260489700000001
               },
               "southwest" : {
                  "lat" : 36.6356229,
                  "lng" : -4.587888599999999
               }
            },
            "location" : {
               "lat" : 36.7167456,
               "lng" : -4.4259962
            },
            "location_type" : "APPROXIMATE",
            "viewport" : {
               "northeast" : {
                  "lat" : 36.8940412,
                  "lng" : -4.260489700000001
               },
               "southwest" : {
                  "lat" : 36.6356229,
                  "lng" : -4.587888599999999
               }
            }
         },
         "place_id" : "ChIJUdEwjWn2cg0RgOZ2pXjSAwQ",
         "types" : [ "administrative_area_level_4", "political" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_3", "political" ]
            },
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            }
         ],
         "formatted_address" : "Málaga, España",
         "geometry" : {
            "bounds" : {
               "northeast" : {
                  "lat" : 36.894041,
                  "lng" : -4.2604898
               },
               "southwest" : {
                  "lat" : 36.6345687,
                  "lng" : -4.587888599999999
               }
            },
            "location" : {
               "lat" : 36.7213069,
               "lng" : -4.4211503
            },
            "location_type" : "APPROXIMATE",
            "viewport" : {
               "northeast" : {
                  "lat" : 36.894041,
                  "lng" : -4.2604898
               },
               "southwest" : {
                  "lat" : 36.6345687,
                  "lng" : -4.587888599999999
               }
            }
         },
         "place_id" : "ChIJ0ZsZCUL2cg0RfLkFYbZzC04",
         "types" : [ "administrative_area_level_3", "political" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "Málaga",
               "short_name" : "Málaga",
               "types" : [ "administrative_area_level_2", "political" ]
            },
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            }
         ],
         "formatted_address" : "Málaga, España",
         "geometry" : {
            "bounds" : {
               "northeast" : {
                  "lat" : 37.2824026,
                  "lng" : -3.765967
               },
               "southwest" : {
                  "lat" : 36.3102805,
                  "lng" : -5.6117767
               }
            },
            "location" : {
               "lat" : 36.7211113,
               "lng" : -4.4210306
            },
            "location_type" : "APPROXIMATE",
            "viewport" : {
               "northeast" : {
                  "lat" : 37.2824026,
                  "lng" : -3.765967
               },
               "southwest" : {
                  "lat" : 36.3102805,
                  "lng" : -5.6117767
               }
            }
         },
         "place_id" : "ChIJUyii_DXqcg0RAMt1pXjSAwM",
         "types" : [ "administrative_area_level_2", "political" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "Andalucía",
               "short_name" : "AL",
               "types" : [ "administrative_area_level_1", "political" ]
            },
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            }
         ],
         "formatted_address" : "Andalucía, España",
         "geometry" : {
            "bounds" : {
               "northeast" : {
                  "lat" : 38.7290872,
                  "lng" : -1.6301238
               },
               "southwest" : {
                  "lat" : 35.9376148,
                  "lng" : -7.522877500000001
               }
            },
            "location" : {
               "lat" : 37.5442706,
               "lng" : -4.7277528
            },
            "location_type" : "APPROXIMATE",
            "viewport" : {
               "northeast" : {
                  "lat" : 38.7290872,
                  "lng" : -1.6301238
               },
               "southwest" : {
                  "lat" : 35.9376148,
                  "lng" : -7.522877500000001
               }
            }
         },
         "place_id" : "ChIJRcWdz7HZEQ0RD_Pxd01lycE",
         "types" : [ "administrative_area_level_1", "political" ]
      },
      {
         "address_components" : [
            {
               "long_name" : "España",
               "short_name" : "ES",
               "types" : [ "country", "political" ]
            }
         ],
         "formatted_address" : "España",
         "geometry" : {
            "bounds" : {
               "northeast" : {
                  "lat" : 43.8504,
                  "lng" : 4.6362
               },
               "southwest" : {
                  "lat" : 27.4985,
                  "lng" : -18.2648001
               }
            },
            "location" : {
               "lat" : 40.46366700000001,
               "lng" : -3.74922
            },
            "location_type" : "APPROXIMATE",
            "viewport" : {
               "northeast" : {
                  "lat" : 43.8504,
                  "lng" : 4.6362
               },
               "southwest" : {
                  "lat" : 27.4985,
                  "lng" : -18.2648001
               }
            }
         },
         "place_id" : "ChIJi7xhMnjjQgwR7KNoB5Qs7KY",
         "types" : [ "country", "political" ]
      }
   ],
   "status" : "OK"
}
