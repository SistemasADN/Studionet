<?php
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  $menus['home'] = [
    ["href"=>'home']
  ];

  $menus['administracion'] = [
    ["href"=>'administracionMain'],
    [
      "href"=>'administracionIngresosCapturar',
      "icon"=>'plus',
      "text"=>'INGRESOS',
      "list"=>[
        ["href"=>'administracionIngresosVer', "text"=>'VER INGRESOS'],
        ["href"=>'administracionPagosRecibidos', "text"=>'RECIBOS DE PAGO']
      ]
    ],
    [
      "href"=>'administracionEgresos',
      "icon"=>'minus',
      "text"=>'EGRESOS',
      "list"=>[
        ["href"=>'administracionEgresosVer', "text"=>'VER EGRESOS'],
        ["href"=>'administracionPagosNomina', "text"=>'RECIBOS DE NOMINA']
      ]
    ],
    [
      "href"=>'administracionMovimientosVer',
      "icon"=>'exchange',
      "text"=>'MOVIMIENTOS',
      "list"=>[
      ]
    ],
    [
      "icon"=>'ticket',
      "text"=>'COBRANZA',
      "list"=>[
        ["href"=>'perfilConfiguracionPagos', "text"=>'CONFIGURACI&Oacute;N COBRANZA'],
        ["href"=>'generarCobranza', "text"=>'GENERAR COBRANZA MENSUAL'],
        ["href"=>'administracionRecibosCobroConceptosGenerarVarios', "text"=>'GENERAR COBROS ADICIONALES'],
        ["href"=>'administracionRecibosCobroVer', "text"=>'VER CARTA DE COBRO'],
        ["href"=>'administracionRecibosCobroConceptosGenerar', "text"=>'GENERAR CARTA DE COBRO'],

        ["href"=>'administracionCuentasCobrar', "text"=>'CUENTAS POR COBRAR'],

      ]
    ],
    [
      "href"=>'catalogoConceptosVer',
      "icon"=>'list-ul',
      "text"=>'CONCEPTOS',
      "list"=>[
        ["href"=>'catalogoConceptosAgregar', "text"=>'AGREGAR CONCEPTO']
      ]
    ],

    [
      "href"=>'administracionEstadoCuentaCliente',
      "icon"=>'list-ol',
      "text"=>'ESTADO DE CUENTA CLIENTE',
      "list"=>[]
    ],
    [
      "href"=>'administracionEstadoCuentaEmpresa',
      "icon"=>'list-ol',
      "text"=>'ESTADO DE CUENTA EMPRESA',
      "list"=>[]
    ],
    [
      "icon"=>'credit-card',
      "text"=>'REPORTES',
      "list"=>[
          ["href"=>'administracionReportesFacturacion', "text"=>'FACTURACIÓN'],
          ["href"=>'administracionReportesFinanzas', "text"=>'FINANZAS'],
          //["href"=>'administracionReportesUtilidadesGrupo', "text"=>'CLASE'],
          ["href"=>'administracionReportesVentas', "text"=>'VENTAS']
      ]
    ],
    [
      "href"=>'administracionCuentasVer',
      "icon"=>'credit-card',
      "text"=>'CUENTAS',
      "list"=>[
          ["href"=>'administracionCuentasAgregar', "text"=>'AGREGAR CUENTA']
      ]
    ],
    [
      "href"=>'administracionEstadoCuentaSede',
      "icon"=>'list-ol',
      "text"=>'ESTADO DE CUENTA SEDE',
      "list"=>[]
    ],
  ];
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
  /*
  
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
      /**/
        $menus['agenda'] = [
          ["href"=>'agendaMain'],
          [
            "href"=>'agendaVer',
            "icon"=>'calendar-o',
            "text"=>'VER AGENDA',
            "list"=>[]
          ],
      		[
            "href"=>'agendaEventoAgregar',
            "icon"=>'calendar-plus-o',
            "text"=>'AGREGAR EVENTO',
            "list"=>[]
          ]
        ];
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
        /*
        
          /**/
          $menus['asistencia'] = [
            ["href"=>'asistenciaMain'],
            [
              "href"=>'grupoListaAsistencia',
              "icon"=>'th-list',
              "text"=>'PASAR LISTA',
              "list"=>[]
            ],
            [
              "href"=>'grupoCambiosAsistenciaVer',
              "icon"=>'exchange',
              "text"=>'REGISTRO DE CAMBIOS',
              "list"=>[]
            ],
        		[
              "href"=>'grupoListaAsistenciaVer',
              "icon"=>'list-alt',
              "text"=>'VER LISTAS DE ASISTENCIA',
              "list"=>[]
            ],
            [
              "href"=>'grupoAlumnoListaAsistenciaVer',
              "icon"=>'users',
              "text"=>'VER ASISTENCIA ALUMNO',
              "list"=>[]
            ],
            [
              "href"=>'grupoListaTotalAsistenciaVer',
              "icon"=>'users',
              "text"=>'VER ASISTENCIA CLASE',
              "list"=>[]
            ]

          ];
          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          $menus['catalogos'] = [
            ["href"=>'catalogoMain'],
            [
              "href"=>'catalogoSedeVer',
              "icon"=>'institution',
              "text"=>'SUCURSALES',
              "list"=>[
                ["href"=>'catalogoSedesAgregar', "text"=>'AGREGAR SUCURSAL']
              ]
            ],
            [
              "href"=>'catalogoUsuariosVer',
              "icon"=>'user-circle-o',
              "text"=>'USUARIOS',
              "list"=>[
                ["href"=>'catalogoUsuariosProfesor', "text"=>'LIGAR USUARIO PROFESOR'],
                ["href"=>'catalogoUsuariosAgregar', "text"=>'AGREGAR USUARIO'],
                ["href"=>'administracionSedeVer', "text"=>'SEDES ADMINISTRADOR']
              ]
            ],
            [
              "href"=>'catalogoPersonalVer',
              "icon"=>'user-o',
              "text"=>'PERSONAL',
              "list"=>[
                ["href"=>'catalogoPersonalAgregar', "text"=>'AGREGAR PERSONAL']
              ]
            ],

            [
              "href"=>'catalogoDisciplinasVer',
              "icon"=>'bookmark-o',
              "text"=>'DISCIPLINAS',
              "list"=>[
                ["href"=>'catalogoDisciplinasAgregar', "text"=>'AGREGAR DISCIPLINA']
              ]
            ],
            [

              "href"=>'catalogoAsignaturasVer',
              "icon"=>'book',
              "text"=>'CLASES',
              "list"=>[
                ["href"=>'catalogoAsignaturasAgregar', "text"=>'AGREGAR CLASE'],
               /* ["href"=>'catalogoAsignaturasVer', "text"=>'VER CLASES'],*/
                ["href"=>'catalogoNivelesAgregar', "text"=>'AGREGAR NIVEL'],
                ["href"=>'catalogoNivelesVer', "text"=>'VER NIVELES'],
              ]
            ],
            [
              "href"=>'catalogoGruposVer',
              "icon"=>'book',
              "text"=>'GRUPOS',
              "list"=>[
                ["href"=>'catalogoGruposAgregar', "text"=>'AGREGAR GRUPO']
              ]
            ]
            ,
            
            [
              "href"=>'catalogoSalonesVer',
              "icon"=>'building',
              "text"=>'SALONES',
              "list"=>[
                ["href"=>'catalogoSalonesAgregar', "text"=>'AGREGAR SAL&Oacute;N']
              ]
            ],
          ];

          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
          /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

            $menus['clientesAlumnos'] = [
              ["href"=>'clientesAlumnosMain'],
              [
                "href"=>'clientesAlumnosVerClientes',
                "icon"=>'user',
                "text"=>'CLIENTES',
                "list"=>[['href'=>'clientesAlumnosAgregarClientes', 'text'=>"AGREGAR CLIENTES"]]
              ],
              [
                "href"=>'clientesAlumnosVerAlumnos',
                "icon"=>'users',
                "text"=>'ALUMNOS',
                "list"=>[['href'=>'clientesAlumnosAgregarAlumno', 'text'=>"AGREGAR ALUMNO"]]
              ],
              [
                "href"=>'catalogoColegiosVer',
                "icon"=>'graduation-cap',
                "text"=>'COLEGIOS',
                "list"=>[
                  ["href"=>'catalogoColegiosAgregar', "text"=>'AGREGAR COLEGIO'],
                  ["href"=>'catalogoGradosVer', "text"=>'VER GRADOS ESCOLARES'],
                  ['href'=>'catalogoGradosCambiar', 'text'=>"MOVER ALUMNOS DE GRADO ESCOLAR"],
                  ["href"=>'catalogoGradosAgregar', "text"=>'AGREGAR GRADOS ESCOLARES'],
                ]
              ],
            ];


            /**/
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
            /*
            $menus['clientesAlumnosCliente'] = [
                [
                  "href"=>'clientesAlumnosVerAlumnosCliente',
                  "icon"=>'users',
                  "text"=>'CLIENTE Y ALUMNOS',
                  "list"=>[
                    ["href"=>'clientesAlumnosAgregarAlumno', "text"=>'AGREGAR ALUMNO']
                  ]
                ]
              ];
            /**/
              /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                $menus['gestion'] = [
                  ["href"=>'gestionMain'],
                  [
                    "href"=>'gestionAsignarHorario',
                    "icon"=>'calendar-plus-o',
                    "text"=>'ASIGNAR Y BORRAR HORARIO',
                    "list"=>[
                    ]
                  ],
                  /*
                  [
                    "href"=>'inscribirEquipoGrupo',
                    "icon"=>'plus-circle',
                    "text"=>'INSCRIBIR EQUIPO A GRUPO',
                    "list"=>[

                    ]
                  ],
                  */
                  [
                    "href"=>'gestionVerHorarioSalon',
                    "icon"=>'building-o',
                    "text"=>'VER HORARIO SAL&Oacute;N',
                    "list"=>[

                    ]
                  ],

                  [
                    "href"=>'gestionVerHorarioProfesor',
                    "icon"=>'user-o',
                    "text"=>'VER HORARIO PROFESOR',
                    "list"=>[

                    ]
                  ],
                [
                  "href"=>'gestionVerHorarioAlumno',
                  "icon"=>'users',
                  "text"=>'VER HORARIO ALUMNO',
                  "list"=>[

                  ]
                ],
                [
                  "href"=>'gestionVerHorarioGrupo',
                  "icon"=>'book',
                  "text"=>'VER HORARIO GRUPO',
                  "list"=>[

                  ]
                ],

                [
                  "href"=>'gestionVerGrupo',
                  "icon"=>'user-circle',
                  "text"=>'GESTIONAR GRUPOS',
                  "list"=>[
                      ["href"=>'inscribirAlumnosGrupos', "text"=>'INSCRIBIR ALUMNOS A GRUPOS'],
                      ["href"=>'reportesOperativosAlumnos', "text"=>'REPORTE ALUMNOS'],
                  ]
                ],

                [
                    "href"=>'catalogoEquiposVer',
                    "icon"=>'sitemap',
                    "text"=>'EQUIPOS',
                    "list"=>[
                      ["href"=>'catalogoEquiposAgregar', "text"=>'AGREGAR EQUIPO'],
                      ["href"=>'gestionVerEquipo', "text"=>'GESTIONAR EQUIPO'],
                      ["href"=>'gestionEquipoAlumnosCobro', "text"=>'GESTIONAR COBROS DE ALUMNOS']
                    ]
                  ],
                ];
              /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
              /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
              /*
                $menus['mensajeria'] = [
                  [
                    "href"=>'mensajeriaRedactar',
                    "icon"=>'pencil',
                    "text"=>'REDACTAR',
                    "list"=>[
                    ]
                  ],
                  [
                    "href"=>'mensajeriaMensajesVer',
                    "icon"=>'archive',
                    "text"=>'MENSAJES GENERADOS',
                    "list"=>[
                    ]
                  ]
                ];
                /**/
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
                  $menus['perfil'] = [

                      ["href"=>'perfilMain'],
                      [

                        "href"=>'perfilCambiarContrasena',
                        "icon"=>'cog',
                        "text"=>'CAMBIAR CONTRASE&Ntilde;A',
                        "list"=>[]
                      ],
                      [
                        "href"=>'terminos',
                        "icon"=>'briefcase',
                        "text"=>'LEGAL',
                        "list"=>[]
                      ]
                  ];

                  $text = "";

  //Super Administrador
  $clearUsuarioAction[1] =
  [
                    'home','administracionMain','administracionRecibosCobroVer','administracionRecibosCobroConceptosGenerar',
                    'administracionRecibosCobroConceptosGenerarVarios', 'administracionCobranzaMensual', 'administracionPagosRecibidos',
                    'generarCobranza', 'gestionVerHorarioGrupo', 'gestionEquipoAlumnosCobro',
                    'administracionIngresosVer','administracionIngresosCapturar','administracionEgresosVer', 'administracionEgresos','administracionEgresosLenin','administracionCuentasCobrar',
                    'administracionEstadoCuentaCliente','administracionEstadoCuentaEmpresa','administracionReportesFacturacion','administracionReportesFinanzas',
                    'administracionReportesUtilidadesGrupo','administracionReportesVentas','administracionCuentasVer','administracionCuentasAgregar',
                    'reportesOperativosAlumnos', 'catalogoGradosCambiar', 'administracionMovimientosVer',
                    'administracionEstadoCuentaSede','agendaMain','agendaVer','agendaEventoAgregar', 'administracionPagosNomina',
                    'asistenciaMain','grupoAlumnoListaAsistenciaVer', 'inscribirAlumnosGrupos', 'grupoListaTotalAsistenciaVer',
                    'catalogoMain','catalogoSedeVer','catalogoSedesAgregar','catalogoPersonalVer',
                    'catalogoPersonalAgregar','catalogoDisciplinasVer','catalogoDisciplinasAgregar','catalogoAsignaturasVer',
                    'catalogoAsignaturasAgregar','catalogoNivelesVer','catalogoNivelesAgregar','catalogoSalonesVer',
                    'catalogoSalonesAgregar','catalogoClasesVer','catalogoClasesAgregar','catalogoEquiposVer',
                    'catalogoEquiposAgregar','catalogoUsuariosVer','catalogoUsuariosProfesor','catalogoUsuariosAgregar','catalogoColegiosVer',
                    'catalogoColegiosAgregar','catalogoGradosVer','catalogoGradosAgregar','catalogoConceptosVer',
                    'catalogoConceptosAgregar','catalogoGruposVer','catalogoGruposAgregar','clientesAlumnosMain',
                    'clientesAlumnosVerAlumnos','clientesAlumnosAgregarAlumno','clientesAlumnosVerClientes','clientesAlumnosAgregarClientes',
                    'gestionMain','gestionAsignarHorario','inscribirEquipoGrupo','gestionVerHorarioSalon',
                    'gestionVerHorarioProfesor','gestionVerHorarioAlumno','gestionVerGrupo','gestionVerEquipo',
                    'perfilMain','perfilCambiarContrasena','perfilConfiguracionPagos','administracionSedeVer',
                    'grupoListaAsistenciaVer', 'grupoCambiosAsistenciaVer'
    ];

    //Soporte
    $clearUsuarioAction[5] = [
                      'home','administracionMain','administracionRecibosCobroVer','administracionRecibosCobroConceptosGenerar',
                      'administracionRecibosCobroConceptosGenerarVarios', 'administracionCobranzaMensual', 'administracionPagosRecibidos', 'administracionEgresosLenin',
                      'generarCobranza', 'gestionVerHorarioGrupo', 'gestionEquipoAlumnosCobro',
                      'administracionIngresosVer','administracionIngresosCapturar','administracionEgresosVer', 'administracionEgresos','administracionCuentasCobrar',
                      'administracionEstadoCuentaCliente','administracionEstadoCuentaEmpresa','administracionReportesFacturacion','administracionReportesFinanzas',
                      'administracionReportesUtilidadesGrupo','administracionReportesVentas','administracionCuentasVer','administracionCuentasAgregar',
                      'reportesOperativosAlumnos', 'inscribirAlumnosGrupos', 'catalogoGradosCambiar',
                      'administracionEstadoCuentaSede','agendaMain','agendaVer','agendaEventoAgregar', 'administracionPagosNomina',
                      'asistenciaMain','grupoAlumnoListaAsistenciaVer', 'administracionMovimientosVer', 'grupoListaTotalAsistenciaVer',
                      'catalogoMain','catalogoSedeVer','catalogoSedesAgregar','catalogoPersonalVer',
                      'catalogoPersonalAgregar','catalogoDisciplinasVer','catalogoDisciplinasAgregar','catalogoAsignaturasVer',
                      'catalogoAsignaturasAgregar','catalogoNivelesVer','catalogoNivelesAgregar','catalogoSalonesVer',
                      'catalogoSalonesAgregar','catalogoClasesVer','catalogoClasesAgregar','catalogoEquiposVer',
                      'catalogoEquiposAgregar','catalogoUsuariosVer','catalogoUsuariosProfesor',
                      'catalogoUsuariosAgregar','catalogoColegiosVer',
                      'catalogoColegiosAgregar','catalogoGradosVer','catalogoGradosAgregar','catalogoConceptosVer',
                      'catalogoConceptosAgregar','catalogoGruposVer','catalogoGruposAgregar','clientesAlumnosMain',
                      'clientesAlumnosVerAlumnos','clientesAlumnosAgregarAlumno','clientesAlumnosVerClientes','clientesAlumnosAgregarClientes',
                      'gestionMain','gestionAsignarHorario','inscribirEquipoGrupo','gestionVerHorarioSalon',
                      'gestionVerHorarioProfesor','gestionVerHorarioAlumno','gestionVerGrupo','gestionVerEquipo',
                      'perfilMain','perfilCambiarContrasena','perfilConfiguracionPagos','administracionSedeVer',
                      'grupoListaAsistenciaVer', 'grupoCambiosAsistenciaVer'
    ];

    //Administrador Senior
    $clearUsuarioAction[2] =
    [
                'home','administracionMain','administracionRecibosCobroVer','administracionRecibosCobroConceptosGenerar',
                'administracionRecibosCobroConceptosGenerarVarios', 'administracionCobranzaMensual', 'administracionPagosRecibidos',
                'generarCobranza', 'gestionVerHorarioGrupo', 'gestionEquipoAlumnosCobro',
                'administracionIngresosVer','administracionIngresosCapturar','administracionEgresosVer','administracionCuentasCobrar',
                'administracionEstadoCuentaCliente','administracionReportesFacturacion','administracionEgresos',
                'administracionReportesVentas','administracionCuentasVer','administracionCuentasAgregar',
                'reportesOperativosAlumnos', 'inscribirAlumnosGrupos', 'catalogoGradosCambiar', 'grupoListaTotalAsistenciaVer',
                'administracionEstadoCuentaSede','agendaMain','agendaVer','agendaEventoAgregar', 'administracionPagosNomina',
                'catalogoMain','catalogoPersonalVer', 'administracionMovimientosVer',
                'catalogoPersonalAgregar','catalogoDisciplinasVer','catalogoDisciplinasAgregar','catalogoAsignaturasVer',
                'catalogoAsignaturasAgregar','catalogoNivelesVer','catalogoNivelesAgregar','catalogoSalonesVer',
                'catalogoSalonesAgregar','catalogoClasesVer','catalogoClasesAgregar','catalogoEquiposVer',
                'catalogoEquiposAgregar','catalogoColegiosVer',
                'catalogoColegiosAgregar','catalogoGradosVer','catalogoGradosAgregar','catalogoConceptosVer',
                'catalogoConceptosAgregar','catalogoGruposVer','catalogoGruposAgregar','clientesAlumnosMain',
                'clientesAlumnosVerAlumnos','clientesAlumnosAgregarAlumno','clientesAlumnosVerClientes','clientesAlumnosAgregarClientes',
                'gestionMain','gestionAsignarHorario','inscribirEquipoGrupo','gestionVerHorarioSalon',
                'gestionVerHorarioProfesor','gestionVerHorarioAlumno','gestionVerGrupo','gestionVerEquipo',
                'perfilMain','perfilCambiarContrasena','terminos','grupoListaAsistenciaVer', 'grupoCambiosAsistenciaVer'
    ];

     //Profesor
     $clearUsuarioAction[3] =
     [
                'home','asistenciaMain','grupoListaAsistencia','grupoListaAsistenciaVer',
                'grupoAlumnoListaAsistenciaVer','gestionMain','gestionVerHorarioProfesor','perfilMain','perfilCambiarContrasena'
      ];

    //Administrador
     $clearUsuarioAction[4] =
     [
                'home','administracionMain','administracionRecibosCobroVer','administracionRecibosCobroConceptosGenerar',
                'administracionRecibosCobroConceptosGenerarVarios', 'administracionCobranzaMensual', 'administracionPagosRecibidos',
                'administracionIngresosVer','administracionIngresosCapturar','administracionEgresosVer','administracionCuentasCobrar', 'administracionEgresos',
                'administracionEstadoCuentaCliente','administracionReportesFacturacion', 'gestionEquipoAlumnosCobro',
                'administracionReportesVentas', 'gestionAsignarHorario', 'catalogoGradosCambiar',
                'reportesOperativosAlumnos', 'inscribirAlumnosGrupos', 'administracionMovimientosVer',
                'administracionEstadoCuentaSede','asistenciaMain', 'administracionPagosNomina',
                'catalogoMain','catalogoPersonalVer', 'gestionVerHorarioGrupo',
                'catalogoPersonalAgregar','catalogoDisciplinasVer','catalogoDisciplinasAgregar','catalogoAsignaturasVer',
                'catalogoAsignaturasAgregar','catalogoNivelesVer','catalogoNivelesAgregar','catalogoSalonesVer',
                'catalogoSalonesAgregar','catalogoClasesVer','catalogoClasesAgregar','catalogoEquiposVer',
                'catalogoEquiposAgregar','catalogoColegiosVer',
                'catalogoColegiosAgregar','catalogoGradosVer','catalogoGradosAgregar','catalogoConceptosVer',
                'catalogoConceptosAgregar','catalogoGruposVer','catalogoGruposAgregar',
                'grupoAlumnoListaAsistenciaVer','gestionMain','inscribirEquipoGrupo',
                'clientesAlumnosMain','clientesAlumnosVerAlumnos','clientesAlumnosAgregarAlumno','clientesAlumnosVerClientes',
                'clientesAlumnosAgregarClientes',
                'gestionVerHorarioSalon','gestionVerHorarioProfesor','gestionVerHorarioAlumno','gestionVerGrupo',
                'gestionVerEquipo','perfilMain','perfilCambiarContrasena','administracionEgresosLenin',
              'grupoListaAsistenciaVer', 'grupoCambiosAsistenciaVer'
      ];


      //Administracion General
      $clearSedeAction[-1] =
      [
                'home','administracionMain','administracionRecibosCobroVer',
                'administracionCuentasCobrar', 'administracionCobranzaMensual', 'administracionPagosRecibidos',
                'administracionEstadoCuentaCliente','administracionEstadoCuentaEmpresa','administracionReportesFacturacion','administracionReportesFinanzas',
                'administracionReportesUtilidadesGrupo','administracionReportesVentas',
                'reportesOperativosAlumnos', 'grupoListaTotalAsistenciaVer',
                'asistenciaMain', 'catalogoGradosCambiar',
                'grupoAlumnoListaAsistenciaVer','catalogoMain','catalogoSedeVer','catalogoSedesAgregar',
                'catalogoDisciplinasVer','catalogoDisciplinasAgregar',
                'catalogoAsignaturasVer','catalogoAsignaturasAgregar','catalogoNivelesVer','catalogoNivelesAgregar',
                'catalogoClasesVer','catalogoClasesAgregar',
                'catalogoUsuariosVer','catalogoUsuariosAgregar',
                'catalogoColegiosVer','catalogoColegiosAgregar','catalogoGradosVer','catalogoGradosAgregar',
                'clientesAlumnosMain','clientesAlumnosVerAlumnos','clientesAlumnosAgregarAlumno','clientesAlumnosVerClientes',
                'clientesAlumnosAgregarClientes','perfilMain','perfilCambiarContrasena','terminos',
                'administracionSedeVer','catalogoUsuariosProfesor', 'grupoListaAsistenciaVer', 'grupoCambiosAsistenciaVer'
      ];


    //Administracion Por Sede
      $clearSedeAction['Sede'] =
      [
                'home','administracionMain',
                'administracionIngresosVer','administracionIngresosCapturar','administracionEgresosVer','administracionCuentasCobrar',
                'administracionRecibosCobroVer', 'administracionRecibosCobroConceptosGenerarVarios', 'administracionCobranzaMensual',
                'generarCobranza', 'gestionVerHorarioGrupo', 'gestionEquipoAlumnosCobro',
                'administracionRecibosCobroConceptosGenerar', 'administracionPagosRecibidos', 'administracionPagosNomina',
                'administracionEstadoCuentaCliente','administracionReportesFacturacion','administracionReportesFinanzas', 'administracionEgresos',
                'administracionReportesUtilidadesGrupo','administracionReportesVentas','administracionCuentasVer','administracionCuentasAgregar',
                'reportesOperativosAlumnos', 'inscribirAlumnosGrupos', 'catalogoGradosCambiar',
                'administracionEstadoCuentaSede','agendaMain','agendaVer','agendaEventoAgregar',
                'catalogoMain','catalogoPersonalVer', 'administracionMovimientosVer',
                'catalogoPersonalAgregar','catalogoDisciplinasVer','catalogoDisciplinasAgregar','catalogoAsignaturasVer',
                'catalogoAsignaturasAgregar','catalogoNivelesVer','catalogoNivelesAgregar','catalogoSalonesVer',
                'catalogoSalonesAgregar','catalogoClasesVer','catalogoClasesAgregar','catalogoEquiposVer',
                'catalogoEquiposAgregar','catalogoUsuariosAgregar','catalogoColegiosVer',
                'catalogoColegiosAgregar','catalogoGradosVer','catalogoGradosAgregar','catalogoConceptosVer',
                'catalogoConceptosAgregar','catalogoGruposVer','catalogoGruposAgregar','clientesAlumnosMain',
                'clientesAlumnosVerAlumnos','clientesAlumnosAgregarAlumno','clientesAlumnosVerClientes','clientesAlumnosAgregarClientes',
                'gestionMain','gestionAsignarHorario','inscribirEquipoGrupo','gestionVerHorarioSalon',
                'gestionVerHorarioProfesor','gestionVerHorarioAlumno','gestionVerGrupo','gestionVerEquipo',
                'perfilMain','terminos','perfilCambiarContrasena','terminos','perfilConfiguracionPagos',
                'asistenciaMain','grupoListaAsistencia', 'grupoListaAsistenciaVer', 'administracionEgresosLenin',
      ];
      /*
      echo "SUPER ADMINISTRADOR";
      var_dump($clearUsuarioAction[1]);
      echo "ADMIN SENIOR";
      var_dump(array_diff($clearUsuarioAction[1], $clearUsuarioAction[2]));
      echo "PROFESOR";
      var_dump(array_diff($clearUsuarioAction[1], $clearUsuarioAction[3]));
      echo "ADMINISTRADOR";
      var_dump(array_diff($clearUsuarioAction[1], $clearUsuarioAction[4]));
      echo "SOPORTE";
      var_dump(array_diff($clearUsuarioAction[1], $clearUsuarioAction[5]));
      echo "ADMINISTRACION GENERAL";
      var_dump(array_diff($clearUsuarioAction[1], $clearSedeAction[-1]));
      echo "SEDE";
      var_dump(array_diff($clearUsuarioAction[1], $clearSedeAction['Sede']));
      /**/
?>

<script>
  $(document).ready(function () {
    return;
    <?php
    $currentPage = str_replace(".php","",basename($_SERVER['PHP_SELF']));
    $p = "";
    foreach($menus as $mainPage =>$menu){
      //var_dump($menu);exit;
      if($p!=""){ continue; }
      for($i=0;$i<count($menu);$i++){
        if(isset($menu[$i]['href'])){
            if($menu[$i]['href']==$currentPage){
              $p = $mainPage;
              break;
            }
        }
          if(isset($menu[$i]['list'])){
            for($j=0;$j<count($menu[$i]['list']);$j++){
              if($menu[$i]['list'][$j]['href']==$currentPage){
                $p = $mainPage;
                break;
              }
            }
          }
      }
    }
    echo "$('#bar".$p."').addClass('is-selected');";
  ?>
});
</script>

<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <!-- Ver Cartas de Cobro Start -->
<?php
  //var_dump($_SESSION);
    $collapse = "";
    if(!isset($_SESSION['idSede'])){
      $tipoDeSede = 'Sede';
    }else if($_SESSION['idSede']==-1){
      $tipoDeSede = -1;
    }else{
      $tipoDeSede = 'Sede';
    }
    //var_dump($clearUsuarioAction[$_SESSION['idTipoUsuario']]);  var_dump($clearSedeAction[$tipoDeSede]);  var_dump($p);
    if($p!="home"&&in_array($p, $clearUsuarioAction[$_SESSION['idTipoUsuario']])&&in_array($p, $clearSedeAction[$tipoDeSede])){
      //var_dump($p);var_dump($clearUsuarioAction[$_SESSION['idTipoUsuario']]);
      exit;
    }
        $menu = $menus[$p];
        //var_dump($menus[$p]);
        //var_dump($clearUsuarioAction);
        //var_dump($_SESSION['idTipoUsuario']);
      for($i=0;$i<count($menu);$i++){
        if(!isset($menu[$i]['icon'])){
          continue;
        }
        if(isset($menu[$i]['href'])){
          //var_dump($menu[$i]['href']);var_dump($clearUsuarioAction[$_SESSION['idTipoUsuario']]);var_dump(in_array($menu[$i]['href'], $clearUsuarioAction[$_SESSION['idTipoUsuario']]));
            if(in_array($menu[$i]['href'], $clearUsuarioAction[$_SESSION['idTipoUsuario']])&&in_array($menu[$i]['href'], $clearSedeAction[$tipoDeSede])){
              //echo in_array($menu[$i]['href'], $clearUsuarioAction[$_SESSION['idTipoUsuario']]);
              //var_dump($_SESSION);
              //var_dump($clearUsuarioAction[$_SESSION['idTipoUsuario']]);
              //echo in_array($menu[$i]['href'], $clearSedeAction[$tipoDeSede]);
              //var_dump($clearSedeAction[$tipoDeSede]);
              //continuea;
            }else{
              continue;
            }
        }
        if($menu[$i]['text'] == "CAMBIAR MODO ADMINISTRACION"&&$_SESSION['idTipoUsuario']==3){
          continue;
        }

          echo '<div class="panel panel-default catalogo"><button class="panel-heading catalogo" data-parent="#accordion" data-toggle="collapse" href="#collapse'.$i.'" aria-controls="collapse'.$i.'" type="button" data-toggle="collapse" aria-expanded="false"';
          if(isset($menu[$i]['href'])){
            if($menu[$i]['href']==$currentPage){
              $collapse = $i;
            }
            echo 'onclick="location.href = \''.$menu[$i]['href'].'.php\';"';
          }
          echo '><div class="container-fluid panel-title"><div class="container-fluid col-sm-3 col-md-4 col-lg-4 icon-heading"> <i class="fa fa-'.$menu[$i]['icon'].'"></i></div>';
          echo '<div class="container-fluid col-sm-9 col-md-8 col-lg-7 text-heading">'.$menu[$i]['text'].'</div></div></button>';
          echo '<div id="collapse'.$i.'" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading'.$i.'"><div class="panel-body">';
          if(isset($menu[$i]['list'])){
            $nj = 0;
            for($j=0;$j<count($menu[$i]['list']);$j++){
              //var_dump($menu[$i]['list'][$j]['href']);
              if($menu[$i]['list'][$j]['href']){
                //var_dump($clearUsuarioAction[$_SESSION['idTipoUsuario']]);
                //var_dump($clearSedeAction[$tipoDeSede]);
                if(!in_array($menu[$i]['list'][$j]['href'], $clearUsuarioAction[$_SESSION['idTipoUsuario']])||!in_array($menu[$i]['list'][$j]['href'], $clearSedeAction[$tipoDeSede])){
                    //echo "YES! ";
                    continue;
                  }
              }
              //echo $nj;
              if($menu[$i]['list'][$j]['href']==$currentPage){
                $collapse = $i.",".$nj;
              }
              $nj++;
              echo '<div class="list-group"><a href="./'.$menu[$i]['list'][$j]['href'].'.php">';
              echo '<button type="button" class="list-group-item"><div class="textaction"> '.$menu[$i]['list'][$j]['text'].'</div></button></a></div>';
            }
          }
          echo '</div></div></div>';
      }
?>
</div>
<script>
$(document).ready(function (){
  <?php if($collapse>=0&&$collapse!="")echo "Csser.collapse(".$collapse.");"; ?>
});
</script>
