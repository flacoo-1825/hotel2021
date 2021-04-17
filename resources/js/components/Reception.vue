<template>
    <div class="container-fluid">
      <template v-if="factura==0">
              <div class="card">
                  <div class="card-header">
                      <i class="fas fa-chevron-right fa5x"></i> Recepción
                      <button type="button" class="btn btn-success"  @click="openModal('room','products_reception')">
                          <i class="fas fa-cash-register"></i> Venta Extra
                      </button>
                  </div>
                  <div class="card-body">
                      <div class="form-group row">
                          <div class="col-md-6">
                              <div class="input-group">
                                  <select class="form-control col-md-3" v-model="valor">
                                    <option value="state">Estado</option>
                                    <option value="name_type_room">Habitación</option>
                                  </select>
                                  <input type="text" v-model="search" @keyup="listRoomsActive(1,search,valor)"  class="form-control" placeholder="Texto a buscar">
                                  <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                              </div>
                          </div>
                      </div>
                      <div class="container-fluid mb-5">
                        <div class="row row_rooms">
                          <a href="#" class="col-sm-4 col-md-4"  v-for="room in arrayRoom" :key="room.id">
                            <template v-if="room.state=='Disponible'">
                              <div class=" m-1 disponible" @click="openModal('room','create',room)">
                                <div class="card-body p-3 d-flex align-items-center " :class='room.state'>
                                  <i class="fas fa-bed  p-3  mr-3"></i>
                                  <div class="text-center">
                                    <h3 v-text="room.state"></h3>
                                    <h2 v-text="room.number"></h2>
                                    <h5 class="text-value-sm text-black" v-text="room.name_type_room"></h5>
                                  </div>
                                </div>
                              </div>
                            </template>
                            <template v-else>
                              <div @click="openModal('room','edit',room)">
                              <!-- <div @click="factura=1,room"> -->
                                <div class=" m-1 card-body p-3 d-flex align-items-center " :class='room.state'>
                                  <i class="fas fa-bed  p-3  mr-3"></i>
                                  <div class="text-center">
                                    <h3 v-text="room.state"></h3>
                                    <h2 v-text="room.number"></h2>
                                    <h5 class="text-value-sm text-black" v-text="room.name_type_room"></h5>
                                  </div>
                                </div>
                              </div>
                            </template>
                          </a>
                        </div>
                      </div>
                      <nav>
                          <ul class="pagination">
                            <li class="page-item" v-if="pagination.current_page > 1">
                                  <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page - 1,search,valor)">Anterior</a>
                            </li>
                            <li class="page-item" v-for="page in pagesNumber" :key="page" :class="[page == isActived ? 'active' : '']">
                                  <a class="page-link" href="#" @click.prevent="cambiarPagina(page,search,valor)" v-text="page"></a>
                            </li>
                            <li class="page-item" v-if="pagination.current_page < pagination.last_page">
                                  <a class="page-link" href="#" @click.prevent="cambiarPagina(pagination.current_page + 1,search,valor)">Siguiente</a>
                            </li>
                          </ul>
                      </nav>
                      <hr class="mt-4">
                      <div class="row mb-3">
                        <div class="col text-center">
                          <h2>Reservas</h2>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col">
                            <FullCalendar class="calendar" :options="calendarOptions" />
                        </div>
                      </div>
                  </div>
              </div>
              <!--open modal acomp -->
              <div class="modal fade" tabindex="-1" :class="{'mostrar' : add}" >
                <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
                  <div class="modal-content container bg-container-modal">
                    <div class="text-center">
                      <h3 class="modal-title degraded-orange" v-text="titleModal"></h3>
                    </div>
                    <div class="modal-body">
                      <div class="row">
                        <div class="col">
                          <table class="table table-hover  table-sm" >
                            <thead >
                              <tr class="bg-material-orange">
                                <th>Nombre</th>
                                <th>Primer Apellido</th>
                                <th>segundo Apellido</th>
                                <th>Cédula</th>
                                <th>Fecha de Nacimiento</th>
                                <th>Temperatura de entrada</th>
                                <th>Opciones</th>
                              </tr>
                            </thead>
                            <tbody class="bg-white text-center">
                              <tr v-for="acomp in listAcomp " :key="acomp.id">
                                <td v-text="acomp.name_acomp" ></td>
                                <td v-text="acomp.firstSurname_acomp" ></td>
                                <td v-text="acomp.secondSurname_acomp" ></td>
                                <td v-text="acomp.cedula_acomp" ></td>
                                <td v-text="acomp.birth_date_acomp" ></td>
                                <td v-text="acomp.temperature_entry_acomp+'°C'" ></td>
                                <td>
                                  <a href="#" class="btn-floatiing bg-danger"  title="Eliminar" @click="deleteAcomp(acomp)" >
                                    <i class="fas fa-trash-alt"></i>
                                  </a>
                                </td>
                              </tr>
                            </tbody>
                          </table>
                            </div>
                        </div>
                    </div>
                    <div class="row modal-footer">
                      <div class="col-lg-2">
                        <a class="btn btn-danger  text-white" @click="closeModal('acomp')">Cerrar</a>
                      </div>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                <!-- /.modal-dialog -->
                </div>
              </div>
              <!-- closed modal acomp -->
              <!-- Fin ejemplo de tabla Listado -->
              <div class="modal fade" :class="{'mostrar' : modal == 1 }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable modal-primary modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" v-text="titleModal"></h4>
                              <button type="button" class="close" @click="closeModal('modal')">
                              <span aria-hidden="true">×</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <form action="" method="post" enctype="multipart/form-data" class="form-horizontal product customers">
                                <template v-if="stateRoom=='Disponible'">
                                  <div class="row">
                                      <div class="col-md-3 mb-2"></div>
                                      <div class="col-md-6 mb-2">
                                          <label for="text-input ">Ingrese la cédula del huésped</label>
                                          <input type="text"  class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="cc_client">
                                      </div>
                                  </div>
                                </template>
                                <template v-else-if="stateRoom=='Ocupada'">
                                  <div class="row">
                                    <div class="col-md-6 mb-2 certificate">
                                    </div>
                                    <div class="col-md-6 mb-2 certificate  input-group">
                                        <label for="text-input ">Factura</label>
                                        <h2 v-text="number_check"></h2>
                                    </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-3 mb-2">
                                          <label for="text-input ">Cliente : <span v-text="name_client+' '+firstSurname_client + ' ' +secondSurname_client"></span></label>
                                      </div>
                                      <div class="col-lg-3 mb-2">
                                          <label for="text-input ">Documento <span v-text="cedula_client"></span></label>
                                      </div>
                                      <div class="col-lg-3 mb-2">
                                          <label for="text-input ">Celular <span v-text="phone_client"></span></label>
                                      </div>
                                  </div>
                                </template>
                                <template v-else-if="stateRoom=='certificate'">
                                  <div class="row">
                                    <div class="col-md-6 mb-2 certificate">
                                    </div>
                                    <div class="col-md-6 mb-2 certificate  input-group">
                                        <label for="text-input ">Acta</label>
                                        <h2 v-text="number_certificate"></h2>
                                    </div>
                                  </div>
                                  <div class="row mb-4">
                                      <div class="col-md-12 mb-2 text-center certificate">
                                          <h3>Información del huéped</h3>
                                      </div>
                                  </div>
                                  <div class="row mt-4">
                                      <div class="col-md-4 mb-2">
                                          <label for="text-input ">Cliente</label>
                                          <input type="text" class="form-control" placeholder=""  v-model="name_client">
                                      </div>
                                      <div class="col-sm-12 col-md-4">
                                          <label for="text-input ">Primer apellido</label>
                                          <input type="text" class="form-control" v-model="firstSurname_client"    placeholder="introduzca apellido paterno">
                                      </div>
                                      <div class="col-sm-12 col-md-4">
                                          <label for="text-input ">Segundo apellido</label>
                                          <input type="text" class="form-control" v-model='secondSurname_client'   placeholder="introduzca apellido materno">
                                        </div>
                                  </div>
                                  <div class="row mt-4">
                                      <div class="col-sm-12 col-md-4">
                                          <label for="text-input ">Cédula</label>
                                          <input type="text" class="form-control"  v-model="cedula_client"  v-bind:disabled="desactivar==1" >
                                      </div>
                                      <div class="col-sm-12 col-md-4">
                                          <label for="text-input ">Celular</label>
                                          <input type="text" class="form-control"  v-model=' phone_client '  placeholder="introduzca el celular">
                                      </div>
                                      <div class="col-sm-12 col-md-4">
                                          <label for="email-input ">Nacionalidad</label>
                                          <input type="text" class="form-control"  v-model=' nationality_client '  placeholder="introduzca la nacionalidad">
                                      </div>
                                  </div>
                                  <div class="row mt-4">
                                      <div class="col-sm-12 col-md-4">
                                          <label for="email-input ">Correo Electrónico</label>
                                          <input type="email" class="form-control"  v-model=' email_client '  placeholder="introduzca el correo">
                                      </div>
                                      <div class="col-sm-12 col-md-4">
                                          <label for="text-input ">Ciudad de origen</label>
                                          <input type="text" class="form-control"  v-model="cityOrigin_certificate"  placeholder="introduzca la ciudad">
                                      </div>
                                      <div class="col-sm-12 col-md-4">
                                          <label for="text-input ">Ciudad de destino</label>
                                          <input type="text" class="form-control" v-model="cityDestination_certificate"   placeholder="introduzca la ciudad">
                                      </div>
                                  </div>
                                  <div class="row mt-4">
                                      <div class="col-sm-12 col-md-3 input-group">
                                        <div class="input-group">
                                          <label for="text-input ">Temperatura de entrada</label>
                                        </div>
                                        <input type="number" class="form-control"  v-model="temperature_entry_client"  placeholder="">
                                        <div class="input-group-append">
                                          <span class="input-group-text">°C</span>
                                        </div>
                                      </div>
                                      <!-- <div class="col-sm-12 col-md-3 input-group">
                                        <div class="input-group">
                                          <label for="text-input ">Temperatura de salida</label>
                                        </div>
                                        <input type="number" class="form-control"  v-model="temperature_exit_client" v-bind:disabled="desactivar==1" placeholder="">
                                        <div class="input-group-append">
                                          <span class="input-group-text">°C</span>
                                        </div>
                                      </div> -->
                                      <div class="col-sm-12 col-md-4 input-group">
                                        <div class="input-group">
                                          <label for="text-input ">Fecha de ingreso</label>
                                        </div>
                                          <date-picker v-model="entry_certificate"   :language="es" :lang="lang" valueType="format"></date-picker>
                                      </div>
                                      <div class="col-sm-12 col-md-3 input-group">
                                        <div class="input-group">
                                          <label for="text-input ">Hora de entrada</label>
                                        </div>
                                        <input type="text" class="form-control"  v-model="time_entry_certificate"  placeholder="">
                                      </div>
                                  </div>
                                  <div class="row mb-4 mt-3">
                                      <div class="col-md-12 mb-2 mt-4 certificate text-center ">
                                          <h3>Información del vehículo</h3>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-sm-12 col-md-6">
                                          <label for="text-input ">Placa Auto</label>
                                          <input type="text" class="form-control"  v-model="placaCar_certificate"  placeholder="Ej: MNZ 328">
                                      </div>
                                      <div class="col-sm-12 col-md-6">
                                          <label for="text-input ">Placa Moto</label>
                                          <input type="text" class="form-control"  v-model="placabike_certificate"  placeholder="Ej: MNZ 328">
                                      </div>
                                  </div>
                                  <div class="row mb-4">
                                      <div class="col-md-12 mb-2 mt-4 certificate text-center ">
                                          <h3>Información de los acompañantes</h3>
                                      </div>
                                  </div>
                                  <div class="row mt-4">
                                    <div class="col-lg-4 mb-2">
                                      <label for="text-input ">Nombre</label>
                                      <input type="text" v-model="name_acomp" class="form-control"  placeholder="introduzca el nombre sin apellidos">
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                      <label for="text-input ">Primer apellido</label>
                                      <input type="text" v-model="firstSurname_acomp" class="form-control" placeholder="introduzca apellido paterno">
                                    </div>

                                    <div class="col-lg-4 mb-2">
                                      <label for="text-input ">Segundo apellido</label>
                                      <input type="text" v-model="secondSurname_acomp" class="form-control" placeholder="introduzca apellido materno">
                                    </div>
                                  </div>
                                  <div class="row mt-4">
                                    <div class="col-sm-12 col-lg-4 mb-2">
                                      <label for="text-input ">Cédula</label>
                                      <input type="text" v-model="cedula_acomp" class="form-control" placeholder="introduzca número de cédula">
                                    </div>
                                    <div class="col-sm-12 col-lg-4 mb-2">
                                      <label for="text-input ">Fecha de Nacimiento</label>
                                      <date-picker v-model="birth_date_acomp"   :language="es" :lang="lang" valueType="format"></date-picker>
                                    </div>
                                    <div class="col-sm-12 col-md-4 input-group">
                                      <div class="input-group">
                                        <label for="text-input ">Temperatura de entrada</label>
                                      </div>
                                      <input type="number" class="form-control"  v-model="temperature_entry_acomp"  placeholder="">
                                      <div class="input-group-append">
                                        <span class="input-group-text">°C</span>
                                      </div>
                                    </div>
                                    <div class="col-sm-12 col-md-4 input-group">
                                      <div class="input-group">
                                        <label for="text-input ">Temperatura de salida</label>
                                      </div>
                                      <input type="number" class="form-control"  v-model="temperature_exit_acomp" v-bind:disabled="desactivar==1" placeholder="">
                                      <div class="input-group-append">
                                        <span class="input-group-text">°C</span>
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row mt-4">
                                    <div class="col-md-10">
                                      <a @click="openModal('room','agregar')" href="#" class="btn  btn-info">
                                        <i class="fas fa-list"></i> Ver Lista
                                      </a>
                                    </div>
                                    <div class="col-md-2">
                                      <a @click="addAcomp()" href="#" class="btn  btn-success" title="agregar" >
                                          <i class="fas fa-plus-circle"></i> agregar
                                      </a>
                                    </div>
                                  </div>
                                  <div class="row mt-4">
                                      <div class="col-sm-12 col-md-6">
                                        <label for="text-input ">Cantidad adultos</label>
                                        <input type="number" class="form-control" v-model="adults_certificate"  placeholder="Ej: 1">
                                      </div>
                                      <div class="col-sm-12 col-md-6">
                                        <label for="text-input ">Niños</label>
                                        <input type="number" class="form-control" v-model="children_certificate"  placeholder="Ej: 0">
                                      </div>
                                      <div class="col-sm-12 col-md-12 form-group">
                                          <label for="text-input ">Observaciones</label>
                                          <textarea  class="form-control"   v-model="observation_certificate" rows="2"></textarea>
                                      </div>
                                  </div>
                                  <div class="row mb-3">
                                      <div class="col-md-12 mb-2 mt-4 certificate text-center ">
                                          <h3>Información de la habitación</h3>
                                      </div>
                                  </div>
                                    <div class="row">
                                      <div class="col-sm-12 col-md-4">
                                          <label for="email-input ">Precio habitación</label>
                                          <div class="form-check">
                                            <label class="form-check-label" for="exampleRadios1">
                                              Ventilador : <span class="text-danger">{{ price | currency}}</span>
                                            </label>
                                          </div>
                                          <div class="form-check">
                                            <label class="form-check-label" for="exampleRadios2">
                                              A/C : <span class="text-danger">{{ price_air | currency}}</span>
                                            </label>
                                          </div>
                                      </div>
                                      <div class="col-sm-12 col-md-4">
                                          <label for="text-input ">Habitación : <span v-text="number" class="text-danger"></span></label>
                                      </div>
                                      <div class="col-sm-12 col-md-4">
                                          <label for="text-input ">Tipo de habitación : <span v-text="name_type_room" class="text-danger"></span></label>
                                      </div>
                                  </div>
                                </template>
                                <template v-else-if="stateRoom=='register'">
                                  <div class="row">
                                    <div class="col-lg-4 mb-2">
                                        <label for="text-input ">Nombre</label>
                                        <input type="text" class="form-control" placeholder="" v-model="name_client">
                                    </div>
                                    <div class="col-lg-4 mb-2">
                                        <label for="text-input ">Primer Apellido</label>
                                        <input type="text" class="form-control" placeholder="" v-model="firstSurname_client">
                                    </div>
                                    <div class="col-lg-4 mb-2">
                                        <label for="text-input ">Segundo Apellido</label>
                                        <input type="text" class="form-control" placeholder="" v-model="secondSurname_client">
                                    </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-4 mb-2">
                                          <label for="text-input ">Identificación</label>
                                          <input type="text" class="form-control" placeholder="" v-model="cedula_client">
                                      </div>
                                      <div class="col-lg-4 mb-2">
                                          <label for="text-input ">Edad</label>
                                          <input type="text" class="form-control" placeholder="" v-model="age_client">
                                      </div>
                                      <div class="col-lg-4 mb-2">
                                      <label for="text-input ">Fecha de Nacimiento</label>
                                      <date-picker v-model="birth_date_client"   :language="es" :lang="lang" valueType="format"></date-picker>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-4 mb-2">
                                          <label for="text-input ">Teléfono</label>
                                          <input type="text" class="form-control" placeholder="" v-model="phone_client">
                                      </div>
                                      <div class="col-lg-4 mb-2">
                                          <label for="text-input ">Género</label>
                                          <select class="form-control custom-select " v-model=' gender_client ' >
                                                  <option value="0">Seleccione una opción</option>
                                                  <option>Femenino</option>
                                                  <option>Masculino</option>
                                                  <option>No especifica</option>
                                          </select>
                                      </div>
                                      <div class="col-lg-4 mb-2">
                                          <label for="text-input ">Estado</label>
                                          <select class="form-control custom-select" v-model='state_client ' >
                                                  <option value="0">Seleccione una opción</option>
                                                  <option>Soltero(a)</option>
                                                  <option>Casado(a)</option>
                                                  <option>Union Libre</option>
                                                  <option>Viudo(a)</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-4 mb-2">
                                          <label for="text-input ">Dirección</label>
                                          <input type="text" class="form-control" placeholder="" v-model="address_client">
                                      </div>
                                      <div class="col-lg-4 mb-2">
                                          <label for="text-input ">Ciudad</label>
                                          <input type="text" class="form-control" placeholder="" v-model="city_client">
                                      </div>
                                      <div class="col-lg-4 mb-2">
                                          <label for="text-input ">Nacionalidad</label>
                                          <input type="text" class="form-control" placeholder="" v-model="nationality_client">
                                      </div>
                                  </div>
                                  <div class="row">
                                      <div class="col-lg-4 mb-2">
                                          <label for="text-input ">Correo electrónico</label>
                                          <input type="email" class="form-control"  v-model=' email_client '  placeholder="">
                                      </div>
                                  </div>
                                </template>
                              </form>
                          </div>
                          <div class="modal-footer">
                              <a  class="btn btn-danger  text-white" @click="closeModal('modal')">Cerrar</a>
                              <a  class="btn btn-success  text-white"  @click="search_client(cc_client,option = 1)" v-if="accion==1">Ingresar</a>
                              <a  class="btn btn-success  text-white" @click="registerCustomers()" v-if="accion==3">Registrar</a>
                              <a  class="btn btn-success  text-white" @click="stateBusy()" v-if="accion==4">Hospedar</a>
                          </div>
                      </div>
                  </div>
              </div>
        <!--modal reservar  -->
              <div class="modal fade reservation" :class="{'mostrar' : modal == 4 }" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" style="display: none;" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable modal-primary modal-lg" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <h4 class="modal-title" v-text="titleModal"></h4>
                              <button type="button" class="close" @click="closeModal('modal')">
                              <span aria-hidden="true">×</span>
                              </button>
                          </div>
                          <div class="modal-body">
                              <form action="" method="post" enctype="multipart/form-data" class="form-horizontal product customers">
                                <template v-if="stateRoom=='search'">
                                  <div class="row">
                                      <div class="col-md-3 mb-2"></div>
                                      <div class="col-md-6 mb-2">
                                          <label for="text-input ">Ingrese la cédula del huésped</label>
                                          <input type="text"  class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="cc_client">
                                      </div>
                                  </div>
                                </template>
                              </form>
                          </div>
                          <div class="modal-footer">
                              <a  class="btn btn-danger  text-white" @click="closeModal('modal')">Cerrar</a>
                              <a  class="btn btn-success  text-white"  @click="search_client(cc_client,option = 2)" v-if="accion==1">Buscar</a>
                          </div>
                      </div>
                      <!-- /.modal-content -->
                  </div>
                  <!-- /.modal-dialog -->
              </div>
              <div class="modal" tabindex="-1" :class="{'mostrar' : modal2 }">
                <div class="modal-dialog dialog-scrollable">
                  <div class="modal-content">
                    <div class="modal-header bg-primary">
                      <h5 class="modal-title">Reservas</h5>
                      <button type="button" class="close" @click="closeModal('reservation')" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <div class="row mb-4">
                          <div class="col-md-12 mb-2 text-center certificate">
                              <h3>Información del huéped</h3>
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-md-4 mb-2">
                              <label for="text-input ">Cliente</label>
                              <input type="text" class="form-control" placeholder=""  v-model="name_client">
                          </div>
                          <div class="col-sm-12 col-md-4">
                              <label for="text-input ">Primer apellido</label>
                              <input type="text" class="form-control" v-model="firstSurname_client"    placeholder="introduzca apellido paterno">
                          </div>
                          <div class="col-sm-12 col-md-4">
                              <label for="text-input ">Segundo apellido</label>
                              <input type="text" class="form-control" v-model='secondSurname_client'   placeholder="introduzca apellido materno">
                            </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12 col-md-4">
                              <label for="text-input ">Cédula</label>
                              <input type="text" class="form-control"  v-model="cedula_client"  v-bind:disabled="desactivar==1" >
                          </div>
                          <div class="col-sm-12 col-md-4">
                              <label for="text-input ">Celular</label>
                              <input type="text" class="form-control"  v-model=' phone_client '  placeholder="introduzca el celular">
                          </div>
                          <div class="col-sm-12 col-md-4">
                              <label for="email-input ">Nacionalidad</label>
                              <input type="text" class="form-control"  v-model=' nationality_client '  placeholder="introduzca la nacionalidad">
                          </div>
                      </div>
                      <div class="row">
                          <div class="col-sm-12 col-md-6">
                              <label for="email-input ">Correo Electrónico</label>
                              <input type="email" class="form-control"  v-model=' email_client '  placeholder="introduzca el correo">
                          </div>
                          <div class="col-sm-12 col-md-6  mb-2">
                            <label for="text-input ">Fecha de entrada</label>
                            <date-picker v-model="reservation_date_entry"   :language="es" :lang="lang" valueType="format"></date-picker>
                          </div>
                          <div class="col-sm-12 col-md-6  mb-2">
                            <label for="text-input ">Fecha de salida</label>
                            <date-picker v-model="reservation_date_exit"   :language="es" :lang="lang" valueType="format"></date-picker>
                          </div>
                      </div>
                      <div class="row">
                        <div class="col-sm-12 col-md-6">
                          <div class="form-group">
                              <label class="form-control-label" for="text-input">Tipo de reserva</label>
                              <div>
                                  <select class="form-control custom-select" v-model='condition_state'>
                                      <option value="-R.Editable">Reserva-editable</option>
                                      <option value="-R.Fija">Reserva-fija</option>
                                  </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                          <div class="form-group">
                              <label class="form-control-label" for="text-input">Habitación</label>
                              <div>
                                <select class="form-control custom-select" v-model='room_id'>
                                    <option value="*">Elige una opción</option>
                                    <option v-for="room in arrayRooms"  :Key="room.id" :value="room.id" v-text="room.number"></option>
                                </select>
                              </div>
                          </div>
                        </div>
                        <div class="col-sm-12 col-md-6">
                              <label for="email-input ">Color de tu reserva</label>
                              <input type="color" class="form-control"  v-model=' color ' >
                          </div>
                      </div>
                    </div>
                    <div class="modal-footer">
                      <template v-if = "options">
                        <button type="button" class="btn btn-warning" @click="closeModal('reservation')">
                          <i class="fas fa-times-circle"></i> Cerrar
                        </button>
                        <button type="button" class="btn btn-danger" @click="actionEvent(option=2)"> Eliminar reserva
                          <i class="fas fa-trash-alt"></i>
                        </button>
                        <button type="button" class="btn btn-success" @click="actionEvent(option=1)"> Actualizar reserva
                          <i class="fas fa-exchange-alt"></i>
                        </button>
                      </template>
                      <template v-else>
                        <button type="button" class="btn btn-danger" @click="closeModal('reservation')">
                          <i class="fas fa-times-circle"></i> Cerrar
                        </button>
                        <button type="button" class="btn btn-success" @click="addReservation()"> Generar reserva
                          <i class="far fa-share-square"></i>
                        </button>
                      </template>
                    </div>
                  </div>
                </div>
              </div>
      </template>
      <template v-if="factura==1">
        <div class="card">
                  <div class="card-header">
                      <i class="fas fa-chevron-right fa5x"></i> Factura
                      <span>
                          <button type="button" class="btn btn-danger"  @click="factura=0;closeModal('modal')">
                            <i class="fas fa-times-circle"></i> Cerrar
                          </button>
                          <a  class="btn btn-primary shadow text-white" @click="question()" v-if="accion==2">
                            <i class="fas fa-money-check-alt"></i> Facturar
                          </a>
                          <a  class="btn btn-warning shadow text-black" @click="openModal('room','move')" v-if="accion==2">
                            <i class="fas fa-exchange-alt"></i> Trasladar habitación
                          </a>
                      </span>
                  </div>
                  <div class="card-body">
                      <div class="container-fluid mb-5">
                        <div class="row">
                          <div class="col-md-8 mb-2">
                          </div>
                          <div class="col-md-4 mb-2 certificate  input-group">
                              <label for="text-input ">Factura</label>
                              <h2 v-text="number_facture"></h2>
                          </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12 mb-2 text-center certificate">
                                <h3>Información del huéped</h3>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-sm-12 col-md-4 mb-2 input-group">
                              <label for="text-input ">Cliente :
                                <span v-text="name_client">
                                  </span>
                                  <span v-text="firstSurname_client">&nbsp
                                  </span>
                                  <span v-text="secondSurname_client">&nbsp
                                  </span>
                              </label>
                          </div>
                          <div class="col-md-6 mb-2 input-group">
                              <label for="text-input ">Celular : <span v-text="phone_client"></span></label>
                          </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12 mb-2 text-center certificate">
                                <h3>Detalle habitación</h3>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-md-4 mb-2 input-group">
                              <label for="text-input ">tipo ventilación : <span v-text="frozen"></span></label>
                          </div>
                          <div class="col-md-4 mb-2 input-group">
                              <label for="text-input ">Precio : <span >{{price | currency}}</span></label>
                          </div>
                          <div class="col-md-4 mb-2 input-group">
                              <table class="table table-hover  table-sm text-center" >
                                <thead >
                                  <tr class="d-flex justify-content-end">
                                    <th>Total fatura <span class="text-danger" v-text="number_facture"></span></th>
                                    <th class="bg-success">{{totalFacture | currency}}</th>
                                  </tr>
                                </thead>
                              </table>
                          </div>
                        </div>
                        <hr>
                        <div class="row mb-4 mt-3">
                            <div class="col-md-12 mb-2 text-center certificate">
                                <h3>Días de estadía</h3>
                            </div>
                            <div class="col-md-12 mb-2 text-right certificate">
                                <button type="button" class="btn btn-success"  @click="openModal('room','days')">
                                  <i class="fas fa-calendar-day"></i> Generar día
                                </button>
                            </div>
                        </div>
                        <div class="row">
                          <table class="table table-bordered table-striped table-sm">
                            <thead >
                                <tr>
                                    <th class="text-center">Fecha</th>
                                    <th class="text-center">Tipo de ventilación</th>
                                    <th class="text-center">precio día/hora</th>
                                    <th class="text-center">total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="day in listDays" :Key="day.id">
                                  <td v-text="day.date_day"></td>
                                  <td  v-text="day.type_frozen_day"></td>
                                  <td>{{day.price_day + day.price_hour | currency}}</td>
                                  <td>{{day.total_day | currency}}</td>
                                </tr>
                            </tbody>
                          </table>
                          <table class="table table-hover  table-sm text-center" >
                              <thead >
                                <tr class="d-flex justify-content-end">
                                  <th>Total días</th>
                                  <th class="bg-warning">{{totalDays | currency}}</th>
                                </tr>
                              </thead>
                            </table>
                        </div>
                        <hr>
                        <div class="row mb-4 mt-3">
                            <div class="col-md-12 mb-2 text-center certificate">
                                <h3>Productos consumidos</h3>
                            </div>
                            <div class="col-md-12 mb-2 text-right certificate">
                                <button type="button" class="btn btn-success"  @click="openModal('room','sale')">
                                  <i class="fas fa-cash-register"></i> Venta Extra
                                </button>
                                <button type="button" class="btn btn-info"  @click="openModal('room','additional')">
                                  <i class="fas fa-plus-circle"></i> Adicional
                                </button>
                            </div>
                        </div>
                        <div class="row">
                          <table class="table table-bordered table-striped table-sm">
                            <thead >
                                <tr>
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Factura</th>
                                    <th class="text-center">cantidad</th>
                                    <th class="text-center">total</th>
                                    <th class="text-center">
                                      <span class="custom-control custom-checkbox">
                                        <a href="#" @click="selectAll()" class="btn btn-primary">Seleccionar Todo</a>
                                      </span>
                                      <span class="custom-control custom-checkbox">
                                        <a href="#" class="btn btn-success" @click="openModal('room','reception')" >Generar factura</a>
                                      </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="product in listSales" :Key="product.id">
                                  <td v-text="product.name_product">
                                  </td>
                                  <td  v-text="product.number_bill_sales"></td>
                                  <td  v-text="product.quantity_sales"></td>
                                  <td>{{product.total_sales | currency}}</td>
                                  <td class="d-flex justify-content-center">
                                      <span class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input prueba" :value="product"  :id="product.id" v-model="check" >
                                        <label :for="product.id"  class="custom-control-label" >facturar por recepción</label>
                                      </span>
                                  </td>
                                </tr>
                            </tbody>
                          </table>
                          <table class="table table-hover  table-sm text-center" >
                              <thead >
                                <tr class="d-flex justify-content-end">
                                  <th>Total productos</th>
                                  <th class="bg-warning">{{totalNewSaleFacture | currency}}</th>
                                </tr>
                              </thead>
                            </table>
                        </div>
                        <hr>
                        <div class="row mb-4 mt-3">
                            <div class="col-md-12 mb-2 text-center certificate">
                                <h4>Servicios adicionales</h4>
                            </div>
                        </div>
                        <div class="row">
                          <table class="table table-bordered table-striped table-sm">
                            <thead >
                                <tr>
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Factura</th>
                                    <th class="text-center">total</th>
                                    <th class="text-center">
                                      <span class="custom-control custom-checkbox">
                                        <a href="#" @click="selectAllAdditional()" class="btn btn-primary">Seleccionar Todo</a>
                                      </span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="additional in listAdditional"  :Key="additional.id">
                                  <td v-text="additional.name_additional">
                                  </td>
                                  <td  v-text="additional.number_facture_additional"></td>
                                  <td>{{additional.price_additional | currency}}</td>
                                  <td class="d-flex justify-content-center">
                                      <span class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input additional2" :value="additional"  :id="additional.id+50" v-model="check2" >
                                        <label :for="additional.id+50"  class="custom-control-label" >facturar por recepción</label>
                                      </span>
                                  </td>
                                </tr>
                            </tbody>
                          </table>
                          <table class="table table-hover  table-sm text-center" >
                            <thead >
                              <tr class="d-flex justify-content-end">
                                <th>Total adicionales </th>
                                <th class="bg-warning">{{totalAdditional | currency}}</th>
                              </tr>
                            </thead>
                          </table>
                          <table class="table table-hover  table-sm text-center" >
                            <thead >
                              <tr class="d-flex justify-content-end">
                                <th>Total fatura <span class="text-danger" v-text="number_facture"></span></th>
                                <th class="bg-success">{{totalFacture | currency}}</th>
                              </tr>
                            </thead>
                          </table>
                        </div>
                      </div>
                  </div>
        </div>
      </template>
       <div class="modal fade" tabindex="-1" :class="{'mostrar' : add5 }" >
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                  <div class="modal-content container bg-container-modal">
                    <div class="text-center">
                      <h3 class="modal-title degraded-orange" v-text="titleModal"></h3>
                    </div>
                    <div class="modal-body">
                      <table class="table table-hover  table-sm text-center" >
                        <thead >
                          <tr>
                            <th class="text-center">Tipo ventilación</th>
                            <th class="text-center" >Precio</th>
                            <th class="text-center" >Fecha a generar</th>
                            <th class="text-center" >Generar</th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                              <td>Ventilador</td>
                              <td>{{price | currency}}</td>
                              <td>
                                <date-picker v-model="date_day" v-bind:disabled="desactivar==1"
                                :language="es" :lang="lang" valueType="format">
                                </date-picker>
                              </td>
                              <td>
                                <div>
                                  <a class="btn btn-success  text-white" @click="generateDay(1)">
                                     <i class="fas fa-calendar-day"></i> Generar
                                  </a>
                                </div>
                              </td>
                            </tr>
                            <tr class="text-center">
                              <td>A/C</td>
                              <td>{{price_air | currency}}</td>
                              <td>
                                <date-picker v-model="date_day" v-bind:disabled="desactivar==1"
                                :language="es" :lang="lang" valueType="format">
                                </date-picker>
                              </td>
                              <td>
                                <div>
                                  <a class="btn btn-success  text-white" @click="generateDay(2)">
                                    <i class="fas fa-calendar-day"></i> Generar
                                  </a>
                                </div>
                              </td>
                            </tr>
                        </tbody>
                      </table>
                      <div class="row">
                        <div class="col-sm-11"></div>
                        <template v-if="dayNew==1">
                          <div class="col-sm-1">
                            <a type="button" class="btn btn-floatiing bg-danger"  @click="dayNew=0">
                              <i class="fas fa-minus-circle"></i>
                            </a>
                          </div>
                        </template>
                        <template v-else>
                          <div class="col-sm-1">
                            <a type="button" class="btn btn-floatiing bg-success"  @click="dayNew=1">
                              <i class="fas fa-plus-circle"></i>
                            </a>
                          </div>
                        </template>
                      </div>
                      <template v-if="dayNew">
                        <form action="" method="post" enctype="multipart/form-data" class="form-horizontal customers">
                          <div class="row">
                              <div class="col-lg-4 mb-2">
                                 <label for="text-select ">Tipo de ventilación</label>
                                <select class="form-control" v-model="name_frozen">
                                  <option value="Ventilador">Ventilador</option>
                                  <option value="A/C">A/C</option>
                                </select>
                              </div>
                              <div class="col-lg-4 mb-2">
                                  <label for="text-input ">Precio día</label>
                                  <input class="form-control"  v-model = "price_day">
                              </div>
                              <div class="col-lg-4 mb-2">
                                  <label for="text-input ">Precio hora</label>
                                  <input type="number" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="price_hour">
                              </div>
                              <div class="col-lg-4 mb-2">
                                  <label for="text-input ">Cantidad de horas</label>
                                  <input type="number" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="many_hours_day">
                              </div>
                              <!-- <div class="col-lg-4 mb-2">
                                  <label for="text-input ">Cantidad de días</label>
                                  <input type="number" class="form-control" placeholder="" v-bind:disabled="desactivar==1" v-model="quantity_day">
                              </div> -->
                              <div class="col-lg-4 mb-2">
                                <label for="text-input ">Fecha a generar</label>
                                <date-picker v-model="date_day" v-bind:disabled="desactivar==1"   :language="es" :lang="lang" valueType="format"></date-picker>
                              </div>
                              <div class="col-lg-12 mb-2">
                                <label for="text-input ">Observaciones</label>
                                <textarea  cols="30" rows="4" class="form-control" placeholder="" v-bind:disabled="desactivar==1"
                                v-model="description_day">
                                </textarea>
                              </div>
                          </div>
                        </form>
                      </template>
                    </div>
                    <div class="row modal-footer">
                        <div class="col-lg-2">
                          <a class="btn btn-danger  text-white" @click="closeModal('days')">
                            <i class="fas fa-times-circle"></i> Cerrar
                          </a>
                        </div>
                          <a class="btn btn-success  text-white" @click="generateDay()">
                            <i class="fas fa-calendar-day"></i> Generar
                          </a>
                    </div>
                  </div>
                </div>
      </div>
      <div class="modal fade" tabindex="-1" :class="{'mostrar' : add2}" >
                <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
                  <div class="modal-content container bg-container-modal">
                    <div class="text-center">
                      <h3 class="modal-title degraded-orange" v-text="titleModal"></h3>
                    </div>
                    <div class="modal-body">
                      <template v-if="newSale==2  || newSale==3">
                        <div class="row">
                          <div class="col-md-6 mb-2 certificate  input-group">
                          </div>
                          <div class="col-md-6 mb-2 certificate  input-group">
                              <label for="text-input ">Código</label>
                              <h2 v-text="number_reception"></h2>
                          </div>
                        </div>
                      </template>
                      <div class="row">
                        <div class="col-md-12">
                          <template v-if="newSale==1">
                            <div class="input-group">
                              <input type="text" v-model="search" @keyup="listProductActive(1,search,valor)"  class="form-control" placeholder="Producto a buscar">
                              <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                            </div>
                          </template>
                        </div>
                        <div class="col">
                          <table class="table table-hover  table-sm text-center" >
                            <template v-if="newSale==1 || newSale==2 || newSale==3">
                              <thead>
                                <tr>
                                  <th class="text-center">Producto</th>
                                  <th class="text-center">Precio C/u</th>
                                  <th class="text-center">cantidad</th>
                                  <th class="text-center">total</th>
                                </tr>
                              </thead>
                            </template>
                            <template v-if="newSale==1">
                              <tbody class="bg-white text-center table-bordered">
                                <tr v-for="product in arrayProducts " :key="product.id">
                                  <td v-text="product.name_product"></td>
                                  <td  >Precio : {{product.sale_product | currency}} </td>
                                  <td>
                                    <input type="number" v-model="cantidad_product">
                                  </td>
                                  <td>{{product.sale_product*cantidad_product | currency}}</td>
                                  <!-- <td v-text:format="dateformat(acomp.birth_date_acomp)"></td> -->
                                  <td>
                                    <a href="#" class="btn btn-success "  title="Agregar" @click="addProduct(product)" >
                                      <i class="fas fa-trash-alt"></i> Agregar
                                    </a>
                                  </td>
                                </tr>
                              </tbody>
                            </template>
                            <template v-if="newSale==2">
                              <tbody class="bg-white text-center table-bordered">
                                <tr v-for="product in check " :key="product.id">
                                  <td v-text="product.name_product"></td>
                                  <td  >Precio : {{product.price_unit_sales | currency}} </td>
                                  <td v-text="product.quantity_sales"></td>
                                  <td>{{product.total_sales | currency}} </td>
                                </tr>
                                <tr v-for="additional in check2 " :key="additional.id+60">
                                  <td v-text="additional.name_additional"></td>
                                  <td  >Precio : {{additional.price_additional | currency}} </td>
                                  <td v-text="1"></td>
                                  <td>{{additional.price_additional | currency}} </td>
                                </tr>
                              </tbody>
                            </template>
                            <template v-if="newSale==3">
                              <tbody class="bg-white text-center table-bordered">
                                <tr v-for="product in check " :key="product.id">
                                  <td v-text="product.name_product"></td>
                                  <td  >Precio : {{product.sale_product | currency}} </td>
                                  <td v-text="product.cantidad_product"></td>
                                  <td>{{product.cantidad_product * product.sale_product | currency}} </td>
                                </tr>
                              </tbody>
                            </template>
                          </table>
                          <template v-if="newSale==2">
                            <table class="table table-hover  table-sm text-center" >
                              <thead >
                                <tr class="d-flex justify-content-end">
                                  <th>total</th>
                                  <th>{{totalNewSale + totalSaleAdditional | currency}}</th>
                                  <!-- <td>{{totalSaleAdditional | currency}} </td> -->

                                </tr>
                              </thead>
                            </table>
                          </template>
                          <template v-if="newSale==3">
                            <table class="table table-hover  table-sm text-center" >
                              <thead >
                                <tr class="d-flex justify-content-end">
                                  <th>total</th>
                                  <th>{{totalNewSaleReception | currency}}</th>
                                </tr>
                              </thead>
                            </table>
                          </template>
                        </div>
                      </div>
                      <template v-if="move==1">
                        <div class="row text-center">
                          <div class="col">
                            <h4>Elige la habitación</h4>
                          </div>
                        </div>
                        <hr>
                        <div class="row p-4">
                              <div class="form-check col-sm-3" v-for="room in listRoomFree" :key="room.id">
                                <input class="form-check-input" type="radio" name="exampleRadios" :id="room.id" :value="room" v-model = "roomMove">
                                <label class="form-check-label" :for="room.id">
                                  <i class="fas fa-bed text-success fa-2x"></i><span class="p-1 fa-2x" v-text="room.number"></span>
                                </label>
                              </div>
                        </div>
                      </template>
                    </div>
                    <div class="row modal-footer">
                      <template v-if="newSale==1 || newSale==2 || newSale==3">
                        <div class="col-lg-2">
                          <a class="btn btn-danger  text-white" @click="closeModal('product')">
                            <i class="fas fa-times-circle"></i> Cerrar
                          </a>
                        </div>
                      </template>
                      <template v-if="modal==3">
                        <div class="col-lg-12 d-flex justify-content-between">
                          <a class="btn btn-danger  text-white" @click="closeModal('Move')">
                            <i class="fas fa-times-circle"></i> Cerrar
                          </a>
                          <a class="btn btn-success  text-white" @click="moveRoom()">
                            <i class="fas fa-exchange-alt"></i> Trasladar
                          </a>
                        </div>
                      </template>
                      <template v-if="newSale==2">
                        <div class="col-lg-2">
                          <a class="btn btn-success text-white" @click="saleNewReception()">
                            <i class="fas fa-money-check-alt"></i> Facturar <!--facturar por recepción -->
                          </a>
                        </div>
                      </template>
                      <template v-if="newSale==3">
                        <div class="col-lg-2">
                          <a class="btn btn-success text-white" @click="addSaleReception()">
                            <i class="fas fa-money-check-alt"></i> Facturar
                          </a>
                        </div>
                      </template>
                    </div>
                    <!-- /.modal-content -->
                  </div>
                <!-- /.modal-dialog -->
                </div>
      </div>
      <!-- modal addition -->
      <div class="modal fade" tabindex="-1" :class="{'mostrar' : add3}" >
          <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content container bg-container-modal">
                <div class="text-center">
                  <h3 class="modal-title degraded-orange" v-text="titleModal"></h3>
                </div>
                <div class="modal-body">
                  <div class="row">
                    <div class="col-md-12">
                        <div class="input-group">
                          <input type="text" v-model="search" @keyup="listServicieActive(search)"  class="form-control" placeholder="Adicional a buscar">
                          <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Buscar</button>
                        </div>
                    </div>
                    <div class="col">
                      <table class="table table-hover  table-sm text-center" >
                          <thead >
                            <tr>
                              <th>Producto</th>
                              <th>Precio C/u</th>
                              <th>subtotal</th>
                              <th>total</th>
                            </tr>
                          </thead>
                          <tbody class="bg-white text-center table-bordered">
                            <tr v-for="servicie in arrayServicie " :key="servicie.id">
                              <td v-text="servicie.name_servicie"></td>
                              <td  >Precio : {{servicie.price_servicie | currency}} </td>
                              <td>{{servicie.price_servicie | currency}}</td>
                              <td>
                                <a href="#" class="btn btn-success "  title="Agregar" @click="addAdditional(servicie)" >
                                  <i class="fas fa-trash-alt"></i> Agregar
                                </a>
                              </td>
                            </tr>
                          </tbody>
                      </table>
                      <div class="row text-right">
                        <template v-if="addAddition==0">
                          <div class="col">
                            <a class="btn btn-floating bg-success" @click="addAddition=1" href="#"><i class="fas fa-plus"></i></a>
                          </div>
                        </template>
                        <template v-if="addAddition==1">
                          <div class="col">
                            <form action="" method="post" enctype="multipart/form-data" class="form-horizontal additional">
                                <div class="row text-left">
                                    <div class="col-lg-6 mb-2">
                                        <label for="text-input ">Nombre adicional</label>
                                        <input type="text" class="form-control" disabled  v-model="name_servicie">
                                    </div>
                                    <div class="col-lg-6 mb-2">
                                        <label for="text-input ">Precio</label>
                                        <input type="number" class="form-control" v-model="price_servicie">
                                    </div>
                                    <div class="col-lg-12 mb-2">
                                        <label for="text-input ">Descripción</label>
                                        <textarea  cols="30" rows="4" class="form-control" v-model="description_servicie"></textarea>
                                    </div>
                                </div>
                                <div>
                                  <a href="#" class="btn btn-success btn-block" @click="FormAdditional()">Agregar adicional</a>
                                </div>
                            </form>
                          </div>
                        </template>
                      </div>
                      <template v-if="listAdditional.length!=0">
                        <hr>
                        <div class="row text-center">
                          <div class="col">
                            <h4>Servicios que se cargaran a la habitación</h4>
                          </div>
                        </div>
                        <table class="table table-bordered table-striped table-sm">
                          <thead >
                              <tr>
                                  <th class="text-center">Producto</th>
                                  <th class="text-center">Factura</th>
                                  <th class="text-center">total</th>
                                  <th class="text-center">Opción</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr class="text-center" v-for="additional in listAdditional" :Key="additional.additional_id">
                                <td v-text="additional.name_additional">
                                </td>
                                <td  v-text="additional.number_facture"></td>
                                <!-- <td  v-text="additional.quantity_sales"></td> -->
                                <td>{{additional.total | currency}}</td>
                                <td class="d-flex justify-content-center">
                                  <a href="#" class="btn btn-danger btn-sm" title="Inactivo"  @click="deleteAddition(additional)"><i class="fas fa-trash-alt">
                                    </i> Eliminar
                                  </a>
                                </td>
                              </tr>
                          </tbody>
                        </table>
                      </template>
                    </div>
                  </div>
                </div>
                <div class="row modal-footer">
                    <div class="col-lg-2">
                      <a class="btn btn-danger  text-white" @click="closeModal('additional')">
                        <i class="fas fa-times-circle"></i> Cerrar
                      </a>
                    </div>
                    <div class="col-lg-2">
                      <a class="btn btn-success text-white" @click="addAdditionalRoom()">
                        <i class="fas fa-plus-circle"></i> Agregar
                      </a>
                    </div>
                </div>
            </div>
          </div>
      </div>
      <div class="modal fade" tabindex="-1" :class="{'mostrar' : add4}" >
          <div class="modal-dialog modal-dialog-scrollable modal-lg" role="document">
            <div class="modal-content container bg-container-modal">
                <div class="text-center">
                  <h3 class="modal-title degraded-orange" v-text="titleModal"></h3>
                </div>
                <div class="modal-body">
                  <div class="loader">Loading...</div>
                </div>
            </div>
          </div>
      </div>
      <template v-if="factura==2">
        <div class="card">
                  <div class="card-header">
                      <i class="fas fa-chevron-right fa5x"></i>
                      <span>
                          <button type="button" class="btn btn-danger"  @click="factura=0;search='';closeModal('product');arrayProducts=[]">
                            <i class="fas fa-times-circle"></i> Cerrar
                          </button>
                          <a  class="btn btn-info shadow text-white" @click="addSaleRoom()" v-if="accion==2">
                            <i class="fas fa-money-check-alt"></i> Agregar a la habitación
                          </a>
                          <a href="#" class="btn btn-primary shadow" @click="openModal('room','receptionCheck')" v-if="accion==3">
                            <i class="fas fa-cash-register"></i> Generar factura
                          </a>
                      </span>
                  </div>
                  <div class="card-body">
                      <div class="container-fluid mb-5">
                        <div class="row">
                          <div class="col-md-8 mb-2">
                          </div>
                          <div class="col-md-4 mb-2 certificate  input-group">
                              <label for="text-input ">Factura</label>
                              <h2 v-text="number_facture"></h2>
                          </div>
                        </div>
                        <div class="row mb-4">
                            <div class="col-md-12 mb-2 text-center certificate">
                                <h3>Productos para ser facturados</h3>
                            </div>
                            <div class="col-md-12 mb-2 text-right certificate">
                                <button type="button" class="btn btn-success"  @click="openModal('room','products')">
                                  <i class="fas fa-plus-circle"></i> Venta Extra
                                </button>
                            </div>
                        </div>
                        <div class="row">
                          <table class="table table-bordered table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Producto</th>
                                    <th>valor C/u</th>
                                    <th>Cantidad</th>
                                    <th>subTotal
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="text-center" v-for="product in listProduct" :Key="product.id">
                                  <td class="imgProduct">
                                    <img :src="ruta+product.url_img" alt="not fount">
                                  </td>
                                  <td>{{product.sale_product | currency}}</td>
                                  <td  v-text="product.cantidad_product"></td>
                                  <td class="d-flex justify-content-between">
                                      <span>{{product.sale_product*product.cantidad_product | currency}}</span>
                                      <a href="#" class="btn btn-danger btn-sm" title="Inactivo"  @click="deleteProduct(product)"><i class="fas fa-trash-alt">
                                        </i> Eliminar
                                      </a>
                                  </td>
                                </tr>
                            </tbody>
                          </table>
                          <table class="table table-hover  table-sm text-center" >
                              <thead >
                                <tr class="d-flex justify-content-end">
                                  <th>total</th>
                                  <th>{{totalNewSaleRoom | currency}}</th>
                                </tr>
                              </thead>
                          </table>
                        </div>
                      </div>
                  </div>
        </div>
      </template>
    </div>
</template>

<script>
  import FullCalendar from '@fullcalendar/vue'
  import dayGridPlugin from '@fullcalendar/daygrid'
  import interactionPlugin from '@fullcalendar/interaction'
  import DatePicker from 'vue2-datepicker';
  import 'vue2-datepicker/index.css';
  import {es}  from 'vue2-datepicker/locale/es';
  import VueCurrencyFilter from 'vue-currency-filter'
  Vue.use(VueCurrencyFilter, {
    symbol: '$', // El símbolo, por ejemplo €
    thousandsSeparator: ',', // Separador de miles
    fractionCount: 1, // ¿Cuántos decimales mostrar?
    fractionSeparator: '.', // Separador de decimales
    symbolPosition: 'front', // Posición del símbolo. Puede ser al inicio ('front') o al final ('') es decir, si queremos que sea al final, en lugar de front ponemos una cadena vacía ''
    symbolSpacing: true // Indica si debe poner un espacio entre el símbolo y la cantidad
  })
  export default {
     components: {
        FullCalendar // make the <FullCalendar> tag available
      },
    data() {
        return {
            lang: {
                formatLocale: {
                    firstDayOfWeek: 7,
                    },
                    monthBeforeYear: false,
            },
            calendarOptions: {
              plugins: [ dayGridPlugin, interactionPlugin ],
              initialView: 'dayGridMonth',
              dateClick: this.reservar,
              eventClick:this.eventClick,
              locale : 'es',
              headerToolbar : {
                start: '', // will normally be on the left. if RTL, will be on the right
                center: 'title',
                end: 'prev,next' // will normally be on the right. if RTL, will be on the left
              },
              events: [],
            },
            many_hours_day : 0,
            quantity_day : 0,
            description_day : '',
            price_hour : 0,
            price_day : 0,
            date_day : '',
            dayNew : 0,
            hoursDay : 0,
            listDays : [],
            total_days : 0,
            total_bill : 0,
            total_product_sale : 0,
            total_additionals : 0, 
            time_entry_certificate : '',
            temperature_exit_acomp : 0,
            temperature_entry_acomp : 0,
            options : 0,
            reservation_id : 0,
            color: "#df2020",
            room_id : '*',
            arrayRooms : [],
            condition_state : '-R.Editable',
            id : 1,
            reservation_date_entry : '',
            reservation_date_exit : '',
            name_servicie : 'Compra para habitación',
            price_additional : '',
            description_additional : '',
            addAddition : '',
            roomMove : '',
            move : '',
            name_frozen : 'frozen_air',
            answer : '',
            number_update_ticket : '',
            total_reception : 0,
            option : 0,
            listSales : [],
            newSale: 0,
            eliminar : 0,
            number_facture : '',
            number : 0,
            check : [],
            check2 : [],
            ruta : 'img/products/',
            url_img : '',
            total : '',
            name_product : '',
            sale_product : 0,
            cantidad_product : 1,
            factura : 0,
            number_check : '',
            number_update_reception : '',
            number_reception : '',
            name_room : 'Clase de habitación',
            type_id:0,
            type_room : 0,
            number_update_check : '',
            stateRoom : 'Disponible',
            cc_client: '',
            arrayUsuarioCliente : [],
            additional : [],
            client_id : 0,
            temperature_exit_client : 0,
            temperature_entry_client : 0,
            cedula_client : '',
            entry_certificate : new Date(),
            cityOrigin_certificate : '',
            cityDestination_certificate : '',
            children_certificate : '',
            adults_certificate : '',
            observation_certificate : '',
            placaCar_certificate : '',
            placabike_certificate : '',
            name_client : '',
            firstSurname_client : '',
            secondSurname_client : '',
            phone_client : '',
            birth_date_client : new Date(),
            gender_client : 0,
            age_client : '',
            state_client : 0,
            number_certificate : '032CT',
            number_update : 0,
            email_client : '',
            address_client : '',
            city_client : '',
            nationality_client : '',
            number : '',
            price : '',
            frozen : '',
            state : '',
            price_air : '',
            name_acomp : '',
            firstSurname_acomp : '',
            secondSurname_acomp : '',
            cedula_acomp : '',
            birth_date_acomp : new Date(),
            listAcomp : [],
            listProduct : [],
            arrayroom : [],
            client : [],
            arrayRoom : [],
            arrayProducts : [],
            dataRoom : [],
            listRoomFree : [],
            arrayServicie : [],
            listAdditional : [],
            arrayEvents : [],
            rooms : '',
            opcion : 'Elige una opción',
            modal : 0,
            modal2 : 0,
            titleModal : '',
            accion : 0,
            rooms_id : 0,
            add : 0,
            add2 : 0,
            add3 : 0,
            add4 : 0,
            add5 : 0,
            daysPrice : [],
            desactivar : 0,
            condition : 1,
            search:'',
            valor : 'state',
            arrayError : [],
            pagination : {
                'total' : 0,
                'current_page' : 0,
                'per_page' : 0,
                'last_page' : 0,
                'from' : 0,
                'to' : 0,
            },
            offset : 3,
            es : es,
          }
    },
    computed:{
        //muestra la pagina activa
        isActived: function(){
            return this.pagination.current_page;
        },
        //Calcula las paginas
        pagesNumber: function() {
            if(!this.pagination.to) {
                return [];
            }
            var from = this.pagination.current_page - this.offset;
            if(from < 1) {
                from = 1;
            }

            var to = from + (this.offset * 2);
            if(to >= this.pagination.last_page){
                to = this.pagination.last_page;
            }

            var pagesArray = [];
            while(from <= to) {
                pagesArray.push(from);
                from++;
            }
            return pagesArray;

        },

        totalNewSale: function(){
            var option = 1;
            return this.totalSales(option);
        },

        totalNewSaleRoom: function(){
            var option = 2;
            return this.totalSales(option);
        },
        totalNewSaleFacture: function(){
            var option = 3;
            return this.totalSales(option);
        },

        totalNewSaleAdditional: function(){
            var option = 4;
            return this.totalSales(option);
        },

        totalNewSaleReception: function(){
            var option = 5;
            return this.totalSales(option);
        },

        totalAdditional: function(){
            var option = 6;
            return this.totalSales(option);
        },

        totalSaleAdditional: function(){
            var option = 7;
            return this.totalSales(option);
        },

        totalDays: function(){
            var option = 8;
            return this.totalSales(option);
        },

        totalFacture: function(){
            var option = 9;
            return this.totalSales(option);
        },

    },


    methods : {

        eventClick(info) {
          // alert('date click! ' + arg.dateStr)
          // console.log(info.event._def.title);
          const complement = info.event._def;
          const complement1 = info.event._def.extendedProps;
          // console.log(info.event);

          this.room_id =  complement1.room_id; 
          this.title = complement.title; 
          this.reservation_date_entry = info.event.startStr; 
          this.reservation_date_exit  =  info.event.endStr; 
          this.textColor =  '#000';
          this.color = info.event.backgroundColor;
          this.client_id =  complement1.customer_id;
          this.reservation_id = info.event.id;
          this.search_customer(this.client_id);

        },
        listEvent(){
          let me=this;
          var url = 'reservation';
          axios.get(url).then(function (response) {
            me.arrayEvents= response.data;
            me.calendarOptions['events'] = me.arrayEvents;
            // console.log(me.arrayEvents);
          })
            .catch(function (error) {
              console.log(error);
              });
        },
        actionEvent(option){
          switch (option) {
            case 1:
                var url = 'reservation/update';
                axios.put(url,{
                  'id' :  this.reservation_id,
                  'room_id' : this.room_id,
                  'customer_id' : this.client_id,
                  'reservation_date' :    this.reservation_date,
                  'title': 'H-' + this.arrayRooms[this.room_id-1]['number']+this.condition_state,
                  'start' : this.reservation_date_entry,
                  'end'   : this.reservation_date_exit,
                  'color' : this.color,
                  'textColor' : '#000',
                })
                  .catch(function (error) {
                        console.log(error);
                  });
                this.closeModal('reservation');
                this.listEvent();
                Swal.fire({
                  position: 'top-end',
                  icon: 'success',
                  title: 'Reserva actualizada',
                  showConfirmButton: false,
                  timer: 1500
                });
                this.room_id = '*';
                this.client_id = '';
                this.reservation_date = '';
                this.condition_state = '-R.Editable';
                this.reservation_date_entry = '';
                this.reservation_date_exit = '';
                this.color = '';
              break;

            case 2:
              // console.log(this.reservation_id);
                var url = 'reservation/delete?reservation_id='+ this.reservation_id;
                axios.delete(url,{
                  // 'id' :  this.reservation_id,
                })
                  .catch(function (error) {
                        console.log(error);
                  });
                this.closeModal('reservation');
                this.listEvent();
                Swal.fire({
                  position: 'top-end',
                  icon: 'error',
                  title: 'Reserva eliminada',
                  showConfirmButton: false,
                  timer: 1500
                });
                this.room_id = '*';
                this.client_id = '';
                this.reservation_date = '';
                this.condition_state = '-R.Editable';
                this.reservation_date_entry = '';
                this.reservation_date_exit = '';
                this.color = '';
              break;
          }
        },

        reservar(arg) {
          // console.log(arg);
          this.room_id = '*';
          this.client_id = '';
          this.reservation_date = '';
          this.condition_state = '-R.Editable';
          this.reservation_date_entry = '';
          this.reservation_date_exit = '';
          this.color = '';
          let me = this;
          me.reservation_date_entry = arg.dateStr
          me.openModal('room','search');
        },

        search_customer(customer_id){
          let me=this;
          var url = 'searchCustomer?customer_id='+ customer_id;
          axios.get(url).then(function (response) {
              //  var respuesta= response.data;
              me.client = response.data;
              me.listRoom();
              me.openModal('room','event',me.client);
          })
            .catch(function (error) {
              console.log(error);
              });
        },
        FormAdditional(){
            if (this.price_servicie === '' || this.description_servicie === '') {
              Swal.fire('Debes Completar los campos')
            }else{
                this.additional = {
                'id' : this.id,
                'name_servicie' : this.name_servicie,
                'price_servicie' :this.price_servicie,
                'description_servicie' : this.description_servicie,
              },
              // console.log(this.additional);
              this.addAddition = 0;
              this.price_servicie = '';
              this.description_servicie = '';
              this.addAdditional(this.additional);
            }
        },
        addSaleRoom(){
            let me = this;
            var url  = 'sale/register';
            axios.post(url,{
                'sale' : this.listProduct,
                'number_facture' : this.number_facture,
            }).then(function (response) {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Tus productos se cargaron a la habitación',
                  showConfirmButton: false,
                  timer: 1500
                });
                  var room = [];
                  room = me.dataRoom;
                  // console.log(room);
                  me.openModal('room','edit',room);
              })
              .catch(function (error) {
                    console.log(error);
              });
        },

        addAdditionalRoom(){
            let me = this;
            var url  = 'additional/register';
            axios.post(url,{
                'additional' : this.listAdditional,
                'number_facture' : this.number_facture,
            }).then(function (response) {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Tus adicionales se cargaron a la habitación',
                  showConfirmButton: false,
                  timer: 1500
                });
                  me.closeModal('additional');
                  var room = [];
                  room = me.dataRoom;
                  // console.log(room);
                  me.openModal('room','edit',room);
              })
              .catch(function (error) {
                    console.log(error);
              });
        },
        addSaleReception(){
            let me = this;
            for (let i = 0; i < me.listProduct.length; i++) {
              me.listProduct[i].number_facture = this.number_reception;
              // console.log(me.listProduct);
            };
            var url  = 'sale/register';
            axios.post(url,{
                'sale' : this.listProduct,
            }).then(function (response) {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Venta realizada',
                  showConfirmButton: false,
                  timer: 1600
                });
                me.updateReception();
                me.closeModal('product');
                me.factura = 0;
                me.listProduct = [];
              })
              .catch(function (error) {
                    console.log(error);
              });
        },
        moveRoom(){
          let me=this;
          var url = 'room/updatefacture';
          axios.put(url,{

                      'id' : me.roomMove.id,
                      'number_facture' : me.number_facture,
                      'room_id' : me.rooms_id

          })
            .catch(function (error) {
                  var respuesta = error.response.data;
                  me.arrayError = respuesta.errors;
                  console.log(error.response.data);
            });
           me.closeModal('Move');
           me.closeModal('modal');
           me.factura = 0;
           me.listRoomsActive(1,this.search,this.valor);

        },
        listRoom(){
          let me=this;
          var url = 'room/reservation';
          axios.get(url).then(function (response) {
               me.arrayRooms= response.data;
            
              //console.log( me.arrayRooms[1]['number']);

          })
            .catch(function (error) {
              console.log(error);
              });
        },

        listProductActive(page,search){
          let me=this;
          var valor = 'name_product'
          var url = 'product/active?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.arrayProducts = respuesta.products.data;
               me.pagination= respuesta.pagination;
              // console.log(me.arrayProducts);

          })
            .catch(function (error) {
              console.log(error);
              });
        },

        listServicieActive(search){
          let me=this;
          var url = 'servicie/active?search='+ search;
          axios.get(url).then(function (response) {
              //  var respuesta= response.data;
               me.arrayServicie = response.data;
              //console.log(me.arrayServicie);

          })
            .catch(function (error) {
              console.log(error);
              });
        },

        listRoomsActive(page,search,valor){
          let me=this;
          var url = 'room/active?page=' + page + '&search='+ search + "&valor=" + valor;
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.arrayRoom = respuesta.room.data;
               me.pagination= respuesta.pagination;
              // console.log(respuesta);

          })
            .catch(function (error) {
              console.log(error);
              });
        },

        search_certificate(){
          let me=this;
          var id_search = 1;
          var url = 'counter/searchCertificate';
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.number_update = respuesta[0].number_certificate;
               var end = respuesta[0].end_certificate;
               me.number_certificate = me.number_update+end;
              //  me.arrayRoom = respuesta.room.data;
              // console.log(number+end);

          })
            .catch(function (error) {
              console.log(error);
              });
        },

        search_sales(){
          let me=this;
          var number_facture = this.number_facture;
          var url = 'sale/listSales?number_facture='+number_facture;
          axios.get(url).then(function (response) {
               me.listSales= response.data;
              //  me.listSale = respuesta[0].number_certificate;
              //  me.arrayRoom = respuesta.room.data;
              // console.log(respuesta);

          })
            .catch(function (error) {
              console.log(error);
              });
        },

        search_additional(){
          let me=this;
          var number_facture = this.number_facture;
          var url = 'additional/listAdditional?number_facture='+number_facture;
          axios.get(url).then(function (response) {
               me.listAdditional= response.data;
              // console.log(respuesta);

          })
            .catch(function (error) {
              console.log(error);
              });
        },

        search_check(){
          let me=this;
          var id_search = 1;
          var url = 'counter/searchCheck';
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.number_update_check = respuesta[0].number_check;
               var end = respuesta[0].end_check;
               me.number_check = me.number_update_check+end;
              //  me.arrayRoom = respuesta.room.data;
              //  console.log(me.number_check+end);

          })
            .catch(function (error) {
              console.log(error);
              });
        },

        search_reception(){
          let me=this;
          var url = 'counter/searchReception';
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.number_update_reception = respuesta[0].number_reception;
               var end = respuesta[0].end_reception;
               me.number_reception = me.number_update_reception+end;
              //  me.arrayRoom = respuesta.room.data;
              // console.log(me.number_reception);

          })
            .catch(function (error) {
              console.log(error);
              });
        },
        search_bill(){
          let me=this;
          var url = 'counter/searchTicket';
          axios.get(url).then(function (response) {
               var respuesta= response.data;
               me.number_update_ticket = respuesta[0].number_ticket;
               var end = respuesta[0].end_ticket;
               me.number_ticket = me.number_update_ticket+end;
              //  me.arrayRoom = respuesta.room.data;
              // console.log(me.number_ticket);

          })
            .catch(function (error) {
              console.log(error);
              });
        },
        cambiarPagina(page,search,valor){
          let me = this;
          //Actualiza la página actual
          me.pagination.current_page = page;
          //Envia la petición para visualizar la data de esa página
          me.listRoomsActive(page,search,valor);
        },

        addReservation(){
          let me=this;
          var url = 'reservation/register';
          axios.post(url,{
                      'room_id' : this.room_id,
                      'customer_id' : this.client_id,
                      'reservation_date' :    this.reservation_date,
                      'title': 'H-' + this.arrayRooms[this.room_id-1]['number']+this.condition_state, 
                      'start' : this.reservation_date_entry, 
                      'end'   : this.reservation_date_exit, 
                      'color' : this.color,
                      // 'borderColor' : this.condition_state,
                      'textColor' : '#000',
          })
            .catch(function (error) {
                  var respuesta = error.response.data;
                  me.arrayError = respuesta.errors;
                  console.log(error.response.data);
            });
          me.closeModal('reservation');
          me.listEvent();
          this.room_id = '*';
          this.client_id = '';
          this.reservation_date = '';
          this.condition_state = '-R.Editable'; 
          this.reservation_date_entry = ''; 
          this.reservation_date_exit = ''; 
          this.color = '';
          Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Reserva realizada',
            showConfirmButton: false,
            timer: 1500
          });
        },

        search_client(cc_client,option){

          if (cc_client === '0' || cc_client === '' || cc_client === 0) {
            Swal.fire('Cédula incorrecta');
          }else{
            let me=this;
            const url = 'customers/searchClient?cc_client=' + cc_client;
            axios.get(url).then(function (response) {
                var respuesta= response.data;
                me.arrayUsuarioCliente = respuesta.client;
                // console.log(me.arrayUsuarioCliente);
                if (me.arrayUsuarioCliente.name_client === 'Usuario no registrado') {
                      me.closeModal('modal');
                      const swalWithBootstrapButtons = Swal.mixin({
                      customClass: {
                        confirmButton: 'btn btn-success',
                        cancelButton: 'btn btn-danger'
                      },
                      buttonsStyling: false
                      })
                      swalWithBootstrapButtons.fire({
                        title: 'El huésped no está registrado!',
                        text: "Desea registrar el huésped?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Registrar',
                        cancelButtonText: 'Cancelar!',
                        reverseButtons: true
                      }).then((result) => {
                            if (result.value) { 
                              me.openModal('room','register',me.arrayUsuarioCliente);
                              // swalWithBootstrapButtons.fire(
                              //   'Huésped registrado!',
                              //   'Ya puedes ingresarlo.',
                              //   'success'
                              // )
                            } else if (result.dismiss === Swal.DismissReason.cancel ){
                              swalWithBootstrapButtons.fire(
                                'Cancelado',
                                'Recuerda él huésped no está en la base de datos!',
                                'error'
                              )
                              }
                          })
                }else{
                  switch (option) {
                    case 1: {
                      me.closeModal('modal');
                      me.openModal('room','certificate',me.arrayUsuarioCliente);
                      break;
                    };
                    case 2:{
                      me.closeModal('modal');
                      me.openModal('room','reservation',me.arrayUsuarioCliente);
                      break;
                    }
                      
                  }
                    // me.closeModal('modal');
                    // me.openModal('room','certificate',me.arrayUsuarioCliente);
                }
                
                
                // me.id_client = respuesta.client.id;
            })
              .catch(function (error) {
                console.log(error);
              });
          }
        },

        registerCustomers(){

            let me = this;
            var url  = 'customers/register';
            axios.post(url,{

                        'cedula_client' :    this.cedula_client,
                        'name_client' :    this.name_client,
                        'firstSurname_client' :   this.firstSurname_client,
                        'secondSurname_client'    : this.secondSurname_client,
                        'birth_date_client'    : this.birth_date_client,
                        'gender_client'    : this.gender_client,
                        'age_client'    : this.age_client,
                        'address_client'    : this.address_client,
                        'city_client'    : this.city_client,
                        'nationality_client'    : this.nationality_client,
                        'state_client'    : this.state_client,
                        'phone_client'    : this.phone_client,
                        'email_client'    : this.email_client,
                
                        

            }).then(function (response) {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Tu huésped fue registrado con éxito',
                  showConfirmButton: false,
                  timer: 1500
                });
                  me.closeModal('modal');
                  me.search_client(me.cc_client,me.option);
              })
              .catch(function (error) {
                    var respuesta = error.response.data;
                    me.arrayError = respuesta.errors;
                    console.log(error.response.data);
              });

        },

        registerCertificate(){

                let me = this;
                var url  = 'certificate/register';
                axios.post(url,{

                            'client_id'                   :    this.client_id,
                            'title__certificate'          :    this.title__certificate,
                            'cityOrigin_certificate'      :    this.cityOrigin_certificate,
                            'cityDestination_certificate' :    this.cityDestination_certificate,
                            'placabike_certificate'       :    this.placabike_certificate,
                            'placaCar_certificate'        :    this.placaCar_certificate,
                            'adults_certificate'          :    this.adults_certificate,
                            'children_certificate'        :    this.children_certificate,
                            'entry_certificate'           :    this.entry_certificate,
                            'observation_certificate'     :    this.observation_certificate,
                            'listAcomp'                   :    this.listAcomp,
                            'temperature_exit_client'     :    this.temperature_exit_client,
                            'temperature_entry_client'    :    this.temperature_entry_client,
                            'time_entry_certificate'      :    this.time_entry_certificate,
                            'number_certificate'          :    this.number_certificate

                }).then(function (response) {
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Tu acta fue registrada con éxito',
                      showConfirmButton: false,
                      timer: 1500
                    });

                  })
                  .catch(function (error) {
                        var respuesta = error.response.data;
                        me.arrayError = respuesta.errors;
                        console.log(error.response.data);
                  });

            },
        totalSales(option){
          switch (option){
            case 1 :{
                let total_reception = 0;
                var sales = this.check;
                for(var i = 0; i < sales.length; i++){
                  var item = sales[i]['total_sales'];
                  total_reception += item;
                }
                return total_reception;
                break;
            }

            case 2 :{
                let total_reception = 0;
                var sales = this.listProduct;
                for(var i = 0; i < sales.length; i++){
                  var item = sales[i]['sale_product']*sales[i]['cantidad_product'];
                  total_reception += item;
                }
                return total_reception;
                break;
            }

            case 3 :{
                this.total_product_sale = 0;
                var sales = this.listSales;
                for(var i = 0; i < sales.length; i++){
                  var item = sales[i]['total_sales'];
                  this.total_product_sale += item;
                }
                return this.total_product_sale;
                break;
            }

            case 4 :{
              let total_reception = 0;
              var sales = this.listSales;
              for(var i = 0; i < sales.length; i++){
                var item = sales[i]['total_sales'];
                total_reception += item;
              }
              return total_reception;
              break;
            }

            case 5 :{
              let total_reception = 0;
              var sales = this.listProduct;
              for(var i = 0; i < sales.length; i++){
                var item = sales[i]['total'];
                total_reception += item;
              }
              return total_reception;
              break;
            }

            case 6 :{
              let total_additionals = 0;
              var additionals = this.listAdditional;
              for(var i = 0; i < additionals.length; i++){
                var item = additionals[i]['price_additional'];
                total_additionals += item;
              }
              return total_additionals;
              break;
            }

            case 7 :{
              let total_reception2 = 0;
              var sale_additionals = this.check2;
              for(var i = 0; i < sale_additionals.length; i++){
                var item = sale_additionals[i]['price_additional'];
                total_reception2 += item;
              }
              return total_reception2;
              break;
            }
            case 8 :{
              this.total_days = 0;
              var days = this.listDays;
              for(var i = 0; i < days.length; i++){
                var item = days[i]['total_day'];
                this.total_days += item;
              }
              return this.total_days;
              
              break;
            }

            case 9 :{

               let total_facture = this.totalAdditional + this.totalNewSaleFacture + this.totalDays;
               this.total_bill = total_facture;
               return total_facture;
            }
          }
        },
        generateDay(key){
            // many_hours_day : 0,
            // quantity_day : 0,
            // description_day : '',
            // price_hour : '',
            // price_day : '',
            // date_day : '',
            let price_days = this.price_day;
            let price_hours = this.price_hour;
            switch (key) {
              case 1 :{
                this.price_day = this.price;
                this.name_frozen = 'Ventilador';

                break;
              };
              case 2 : {
                this.price_day = this.price_air;
                this.name_frozen = 'A/C';
                break;
              };
            }
            if (this.many_hours_day == 0) {
              this.total_day = this.price_day;
            } else {
              this.total_day = this.many_hours_day * this.price_hour;

            };
            var url  = 'day/register';
            let me = this;
            axios.post(url,{
              'many_hours_day' : this.many_hours_day,
              'quantity_day' : this.quantity_day,
              'description_day' : this.description_day,
              'price_hour' : this.price_hour,
              'price_day' : this.price_day,
              'date_day' : this.date_day,
              'number_bill_day' : this.number_facture,
              'type_frozen_day' : this.name_frozen,
              'total_day' : this.total_day
            }).then(function (response) {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'Dia cargado a la habitación',
                  showConfirmButton: false,
                  timer: 1500
                });
                  var room = [];
                  room = me.dataRoom;
                  me.search_days();
                  me.closeModal('days');
                  console.log(room);
                  // me.openModal('room','edit',room);
              })
              .catch(function (error) {
                    console.log(error);
              });

        },

        search_days(){
          let me=this;
          var number_facture = this.number_facture;
          var url = 'day/listDays?number_facture='+number_facture;
          axios.get(url).then(function (response) {
               me.listDays= response.data;
              //  me.listSale = respuesta[0].number_certificate;
              //  me.arrayRoom = respuesta.room.data;
              // console.log(me.listDays);

          })
            .catch(function (error) {
              console.log(error);
              });
        },

        openModal(model, accion, data = [] ){
          switch(model){
              case  "room" : {
                  switch(accion){
                      case "create" : {
                          console.log(data);

                          this.search_check();
                          this.modal = 1;
                          this.add = 0;
                          this.stateRoom = 'Disponible'
                          this.desactivar = 0;
                          this.titleModal = 'Ingreso de huésped';
                          this.accion = 1;
                          this.cc_client = '';
                          this.rooms_id = data['id'];
                          this.name_type_room =  data['name_type_room'];
                          this.number =  data['number'];
                          this.price = data['price'];
                          this.price_air = data['price_air']
                        break;
                      };

                      case "edit" :{

                          // console.log(data);
                          this.factura = 1;
                          this.search_bill();
                          this.eleminar = 1;
                          this.add = 0;
                          this.desactivar = 0;
                          this.titleModal = 'Información';
                          this.accion = 2;
                          this.rooms_id = data['id'];
                          this.type_room =  data['type_room_id'];
                          this.title_ =  data['title_'];
                          this.price =  data['price'];
                          this.price_air =  data['price_air'];
                          this.frozen =  data['frozen'];
                          this.state =  data['state'];
                          this.type_id= data['type_room_id'];
                          this.name_client=  data['name_client'];
                          this.cedula_client=  data['cedula_client'];
                          this.phone_client=  data['phone_client'];
                          this.firstSurname_client =  data['firstSurname_client'];
                          this.secondSurname_client =  data['secondSurname_client'];
                          this.title__facture = data['number_facture'];
                          this.name_type_room = data['name_type_room'];
                          this.number_facture = data['number_facture'];
                          this.dataRoom = data;
                          this.search_sales();
                          this.search_additional();
                          this.search_days();



                          break;

                      };

                      case "certificate" :{
                          this.search_certificate();
                          // console.log(data);
                          this.modal = 1;
                          this.add = 0,
                          this.desactivar = 1;
                          this.stateRoom = 'certificate'
                          this.titleModal = 'Acta de entrada';
                          this.accion = 4;
                          this.number_certificate;
                          this.rooms_id ;
                          this.time_entry_certificate = '';
                          this.observation_certificate = '';
                          this.children_certificate = '';
                          this.adults_certificate = '';
                          this.cityOrigin_certificate = '';
                          this.temperature_entry_client = '';
                          this.entry_certificate = '';
                          this.cityDestination_certificate = '';
                          this.name_client = data['name_client'];
                          this.name_type_room =  this.name_type_room;
                          this.number =  this.number;
                          this.price =  this.price;
                          this.price_air =  this.price_air;
                          this.frozen =  data['frozen'];
                          this.state =  data['state'];
                          this.client_id = data['id'];
                          this.type_id= data['type_room_id'];
                          this.cedula_client=  data['cedula_client'];
                          this.firstSurname_client =  data['firstSurname_client'];
                          this.secondSurname_client =  data['secondSurname_client'];
                          this.birth_date_client =  data['birth_date_client'];
                          this.gender_client =  data['gender_client'];
                          this.age_client =  data['age_client'];
                          this.address_client =  data['address_client'];
                          this.city_client =  data['city_client'];
                          this.nationality_client =  data['nationality_client'];
                          this.state_client =  data['state_client'];
                          this.phone_client =  data['phone_client'];
                          this.email_client =  data['email_client'];

                          break;

                      };

                      case "register" :{
                          //console.log(data);
                          this.modal = 1;
                          this.add = 0;
                          this.desactivar = 1;
                          this.stateRoom = 'register'
                          this.titleModal = 'Registro de nuevo huésped';
                          this.accion = 3;
                          this.cedula_client= '';
                          this.name_client = '';
                          this.birth_date_client = '';
                          this.firstSurname_client = '';
                          this.secondSurname_client = '';
                          this.gender_client = 0;
                          this.age_client = '';
                          this.address_client = '';
                          this.city_client = '';
                          this.nationality_client = '';
                          this.state_client = 0;
                          this.phone_client = '';
                          this.email_client = '';
                          break;

                      };

                      case "agregar" :{
                        this.add = 1;
                        this.modal = 0;
                        this.factura = 0;
                        this.titleModal = 'Listado de Acompañantes';

                        break;
                      };

                       case "sale" :{
                        this.add2 = 1;
                        this.newSale = 1;
                        this.factura = 2;
                        this.titleModal = 'Productos';
                        this.listProduct = [];
                        this.number_check;
                        this.number_facture;
                        this.search = '';
                        this.arrayProducts = [];

                        break;
                      };

                      case "products" :{
                        this.add2 = 1;
                        this.newSale = 1;
                        this.titleModal = 'Productos';
                        this.arrayProducts = [];
                        this.name_product = '';
                        this.cantidad_product = 1;
                        this.sale_product = 0;
                        this.search = '';

                        break;
                      };

                      case "products_reception" :{
                        this.add2 = 1;
                        this.accion = 3;
                        this.newSale = 1;
                        this.factura = 2;
                        this.titleModal = 'Productos';
                        this.arrayProducts = [];
                        this.name_product = '';
                        this.cantidad_product = 1;
                        this.sale_product = 0;
                        this.search = '';

                        break;
                      };

                      case "reception" :{
                        this.search_reception();
                        this.add2 = 1;
                        this.newSale = 2;
                        this.titleModal = 'Factura recepción';
                        this.check = this.check;
                        this.name_product = '';
                        this.cantidad_product = 0;
                        this.sale_product = 0;

                        break;
                      };

                       case "receptionCheck" :{
                        this.search_reception();
                        this.add2 = 1;
                        this.newSale = 3;
                        this.titleModal = 'Factura recepción';
                        // this.check = this.listProduct;
                        // this.check2 = this.listAdditional;
                        this.name_product = '';
                        this.cantidad_product = 0;
                        this.sale_product = 0;

                        break;
                      };

                       case "move" :{
                        this.newSale = 0;
                        this.modal = 3;
                        this.add2 = 1;
                        this.move = 1;
                        this.titleModal = 'Trasladar habitación';
                        this.searchRoomMove();

                        break;
                      };

                      case "additional" :{
                        this.add3 = 1;
                        this.titleModal = 'Servicios';
                        this.number_facture;
                        this.search = '';
                        this.listAdditional = [];
                        this.arrayServicie = [];

                        break;
                      };

                       case "search" :{
                          this.listRoom();
                          this.modal = 4;
                          this.stateRoom = 'search'
                          this.desactivar = 0;
                          this.titleModal = 'Reserva a realizar';
                          this.accion = 1;
                          this.cc_client = '';
                          this.search = '';

                        break;
                      };

                      case "reservation" :{
                          this.modal = 0;
                          this.add = 0,
                          this.modal2 = 1 ;
                          this.options = 0,
                          this.desactivar = 1;
                          this.reservation_date_entry = this.reservation_date_entry;
                          this.reservation_date_exit = this.reservation_date_entry;
                          this.children_certificate = '';
                          this.adults_certificate = '';
                          this.name_client = data['name_client'];
                          this.client_id = data['id'];
                          this.cedula_client=  data['cedula_client'];
                          this.firstSurname_client =  data['firstSurname_client'];
                          this.secondSurname_client =  data['secondSurname_client'];
                          this.gender_client =  data['gender_client'];
                          this.address_client =  data['address_client'];
                          this.nationality_client =  data['nationality_client'];
                          this.phone_client =  data['phone_client'];
                          this.email_client =  data['email_client'];
                          break;

                      };

                      case "event" :{
                        // console.log(data);
                          this.modal = 0;
                          this.options = 1,
                          this.add = 0,
                          this.modal2 = 1 ;
                          this.desactivar = 1;
                          this.room_id = this.room_id;
                          this.reservation_date_entry = this.reservation_date_entry;
                          this.reservation_date_exit = this.reservation_date_exit;
                          this.name_client = data[0]['name_client'];
                          this.client_id = data[0]['id'];
                          this.cedula_client=  data[0]['cedula_client'];
                          this.firstSurname_client =  data[0]['firstSurname_client'];
                          this.secondSurname_client =  data[0]['secondSurname_client'];
                          this.gender_client =  data[0]['gender_client'];
                          this.address_client =  data[0]['address_client'];
                          this.nationality_client =  data[0]['nationality_client'];
                          this.phone_client =  data[0]['phone_client'];
                          this.email_client =  data[0]['email_client'];
                          this.color = this.color;
                          break;

                      };
                      case "process" :{
                          this.modal = 0;
                          this.add = 0;
                          this.add2 = 0;
                          this.add3 = 0;
                          this.add4 = 1;
                          this.titleModal = 'Procesando la información';
                        break;
                      };
                      case "days" :{
                          this.add = 0;
                          this.add2 = 0;
                          this.add5 = 1;
                          this.add3 = 0;
                          this.add4 = 0;
                          this.titleModal = 'Generar día';
                          this.price = this.dataRoom['price'];
                          this.frozen = this.dataRoom['frozen'];
                          this.price_air = this.dataRoom['price_air'];
                        break;
                      };
                  }
              }
          }

      },

        closeModal(model){
          switch (model) {
            case "modal":
              this.modal = 0;
              this.search = '';
            // this.arrayError = [];
              this.listRoomsActive(1,this.search,this.valor);
              break;

            case "acomp":
              this.add = 0;
              this.modal = 1;
              this.titleModal ='Acta de entrada';
              this.check = [];
              break;

            case "Move":
              this.add2 = 0;
              this.move = 0;
              this.modal = 0;
              this.check2 = [];
              break;

            case "product":
              this.add2 = 0;
              break;

            case "additional":
              this.add3 = 0;
              this.listAdditional = [];
              this.search = '';
              this.addAddition = 0;
              break;

            case "reservation":
              this.modal2 = 0;
              break;

            case "newSale":
              this.modal2 = 0;
              this.check2 = [];
              break;

            case "process":
              this.add = 0;
              this.add1 = 0;
              this.add2 = 0;
              this.add3 = 0;
              this.add4 = 0;
              break;

            case "days":
              this.add5 = 0;
              break;
          }
        },
        updateCertificate(){
          let me=this;
          var url = 'counter/update';
          axios.put(url,{

                      'option' : 3,
                      'number_certificate' :    this.number_update,

          })
            .catch(function (error) {
                  var respuesta = error.response.data;
                  me.arrayError = respuesta.errors;
                  console.log(error.response.data);
            });

        },
        updateCheck(){
          let me=this;
          var url = 'counter/update';
          axios.put(url,{

                      'option' : 1,
                      'number_check' :    this.number_update_check,

          })
            .catch(function (error) {
                  var respuesta = error.response.data;
                  me.arrayError = respuesta.errors;
                  console.log(error.response.data);
            });

        },
        updateReception(){
          let me=this;
          var url = 'counter/update';
          axios.put(url,{

              'option' : 4,
              'number_reception' :    this.number_update_reception,

          })
            .catch(function (error) {
                  var respuesta = error.response.data;
                  me.arrayError = respuesta.errors;
                  console.log(error.response.data);
            });

        },
         updateBill(){
          let me=this;
          var url = 'counter/update';
          axios.put(url,{

              'option' : 2,
              'number_ticket' :    this.number_update_ticket,

          })
            .catch(function (error) {
                  var respuesta = error.response.data;
                  me.arrayError = respuesta.errors;
                  console.log(error.response.data);
            });

        },
        stateBusy(){

                let me = this;
                me.registerCertificate();
                me.updateCertificate();
                me.updateCheck();
                var url  = 'room/statebusy';
                axios.put(url,{

                            'id' :    this.rooms_id,
                            'client_id' : this.client_id,
                            'number_check' : this.number_check,
                            'number_certificate' : this.number_certificate

                }).then(function (response) {
                    Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Tu habitación queda en estado Ocupada!',
                      showConfirmButton: false,
                      timer: 1500
                    });
                      me.closeModal('modal');
                      me.updateCustomers();
                      me.listRoomsActive(1,this.search,this.valor);
                  })
                  .catch(function (error) {
                        // var respuesta = error.response.data;
                        // me.arrayError = respuesta.errors;
                        // console.log(error.response.data);
                  });

            },

        saleNewReception(){
            let me = this;
            let arrayId = [];
            if (me.check.length == 0 && me.check2.length == 0) {
              Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'No tienes productos para facturar!',
              })

            }else{
              const swalWithBootstrapButtons = Swal.mixin({
              customClass: {
                confirmButton: 'btn btn-success',
                cancelButton: 'btn btn-danger'
              },
              buttonsStyling: false
              })

              swalWithBootstrapButtons.fire({
                title: 'Está seguro?',
                text: "Va a facturar estos productos por recepción!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Si, facturar',
                cancelButtonText: 'No, Cancelar!',
                reverseButtons: true
              }).then((result) => {
                if (result.value) {
                    let me = this;
                    me.openModal('room','process');
                    let sumServicie = 0;
                    for (let i = 0; i < me.check2.length; i++) {
                    if (me.check2[i]['name_additional'] != 'Compra para habitación') {
                      arrayId.push({
                        id : me.check2[i]['id'],
                        type : 'service',
                        number_reception : this.number_reception,
                        price_additional : me.check2[i]['price_additional'] })
                    }else{
                      arrayId.push({
                        id : me.check2[i]['id'],
                        type : 'buyRoom',
                        number_reception : this.number_reception })
                     }
                    };
                    for (let i = 0; i < arrayId.length; i++) {
                      if (arrayId[i]['type'] == 'service') {
                         sumServicie = arrayId[i]['price_additional']+sumServicie;
                      }
                    };
                    // console.log(sumServicie);
                    axios.put('sale/update',{
                          'sale' : this.check,
                          'number_reception' : this.number_reception,
                          'arrayAdditional' : arrayId,
                          'valor_total' : sumServicie,
                    }).then(function (response) {
                          me.registerCheckbooks();
                          me.updateReception();
                          me.closeModal('product');
                          me.check = [];
                          me.check2 = [];
                          var room = [];
                          room = me.dataRoom;
                          me.closeModal('process');
                          me.openModal('room','edit',room);
                    }).catch(function (error) {
                        console.log(error);
                    });
                  swalWithBootstrapButtons.fire(
                    'Facturado!',
                    'Productos fueron facturados por recepción.',
                    'success'
                  )
                } else if (
                  /* Read more about handling dismissals below */
                  result.dismiss === Swal.DismissReason.cancel
                ) {
                  swalWithBootstrapButtons.fire(
                    'Cancelado',
                    'Tus productos siguen cargados en la habitación :)',
                    'error'
                  )
                }
              })
            }
        },

        searchRoomMove(){
            let me=this;
            var url = 'room/move';
            axios.get(url).then(function (response) {
                me.listRoomFree= response.data;
                //  me.listSale = respuesta[0].number_certificate;
                //  me.arrayRoom = respuesta.room.data;
                // console.log(me.listRoomFree);

            })
              .catch(function (error) {
                console.log(error);
                });
        },
        registerBill(answer){
            var answer = this.answer;
              // console.log(answer);
            let me = this;
            var url  = 'bill/register';
            axios.post(url,{

                        'customer_id' :    1,
                        'room_id' :    this.rooms_id,
                        'certificate_id' :   1,
                        'taxe_id'    : null,
                        'number_bill'    : this.number_ticket,
                        'faker_number_bill'    : this.number_facture,
                        'date_entry_bill'    : null,
                        'date_exit_bill'    : null,
                        'dian_bill'    : answer,
                        'total_products'    : this.total_product_sale,
                        'total_days'    : this.total_days,
                        'total_additionals'    : this.total_additionals,
                        'total_bill'    : this.total_bill,
                        'state_bill'    : 1,
                        'class_bill'    : 'Venta',
                        

            }).then(function (response) {
                Swal.fire({
                  position: 'center',
                  icon: 'success',
                  title: 'se creo la factura con éxito',
                  showConfirmButton: false,
                  timer: 1500
                });
                
                me.updateBill();
              })
              .catch(function (error) {
                    var respuesta = error.response.data;
                    me.arrayError = respuesta.errors;
                    console.log(error.response.data);
              });

        },

        registerCheckbooks(){

            let me = this;
            var url  = 'checkbook/register';
            axios.post(url,{

                        'customer_id' :   null,
                        'taxe_id' :    null,
                        'number_checkbooks' :   this.number_reception,
                        'faker_number_checkbooks'    : this.number_reception,
                        'date_exit_checkbooks'    : null,
                        'dian_checkbooks'    : 'No',
                        'total_checkbooks'    : this.total_reception,
                        'state_checkbooks'    : 0,

            })
              .catch(function (error) {
                    var respuesta = error.response.data;
                    me.arrayError = respuesta.errors;
                    console.log(error.response.data);
              });

        },

        question(){
          const swalWithBootstrapButtons = Swal.mixin({
            customClass: {
              confirmButton: 'btn btn-success',
              cancelButton: 'btn btn-danger'
            },
            buttonsStyling: false
          })
          swalWithBootstrapButtons.fire({
                  title: 'Desea factura fÍsica?',
                  icon: 'info',
                  showCancelButton: true,
                  confirmButtonText: 'Si, generar factura',
                  cancelButtonText: 'No, generar factura',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) {

                    this.stateFree(this.answer='Yes');
                  
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                     this.stateFree(this.answer='No');
                  }
                })
        },
        stateFree(answer){
                var answer = this.answer;
                // console.log(answer);
                const swalWithBootstrapButtons = Swal.mixin({
                customClass: {
                  confirmButton: 'btn btn-success',
                  cancelButton: 'btn btn-danger'
                },
                buttonsStyling: false
                })

                swalWithBootstrapButtons.fire({
                  title: 'Está seguro?',
                  text: "Va a facturar ésta habitación!",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonText: 'Si, facturar',
                  cancelButtonText: 'No, Cancelar!',
                  reverseButtons: true
                }).then((result) => {
                  if (result.value) { 
                        this.registerBill(answer);
                        let me = this;
                        var url  = 'room/statefree';
                        axios.put(url,{

                            'id' :    this.rooms_id,
                            // 'client_id' : 1,

                          }).then(function (response) {
                              me.listRoomsActive(1,'','valor');
                              me.factura = 0;
                           
                          }).catch(function (error) {
                              console.log(error);
                          });
                      

                    swalWithBootstrapButtons.fire(
                      
                      'Activado!',
                      'Tu habitación quedó Disponible.',
                      'success'
                    )
                  } else if (
                    /* Read more about handling dismissals below */
                    result.dismiss === Swal.DismissReason.cancel
                  ) {
                    swalWithBootstrapButtons.fire(
                      'Cancelado',
                      'Tu habitacióm sigue Ocupada :)',
                      'error'
                    )
                  }
                })
            },

        addAcomp(){

            if(this.name_acomp!="" && this.firstSurname_acomp!="" && this.secondSurname_acomp!="" && this.cedula_acomp!="" && this.birth_date_acomp!="" && this.temperature_entry_acomp!= 0){

                this.listAcomp.push({
                  name_acomp:this.name_acomp,
                  firstSurname_acomp:this.firstSurname_acomp,
                  secondSurname_acomp:this.secondSurname_acomp,
                  cedula_acomp:this.cedula_acomp,
                  birth_date_acomp:this.birth_date_acomp,
                  temperature_entry_acomp:this.temperature_entry_acomp
                });

                this.name_acomp               = '';
                this.firstSurname_acomp       = '';
                this.secondSurname_acomp      = '';
                this.cedula_acomp             = '';
                this.birth_date_acomp         = '';
                this.temperature_entry_acomp  = 0;
            }
            else{
              Swal.fire('Debes llenar los campos del formulario')
            }

        },
        deleteAcomp(acomp){

           var index =  this.listAcomp.indexOf(acomp);
           this.listAcomp.splice(index,1);

        },
        addProduct(product){
              // console.log(product);
          this.listProduct.push({
            product_id : product.id, 
            name_product:product.name_product, 
            sale_product:product.sale_product, 
            cantidad_product:this.cantidad_product,
            total:product.sale_product*this.cantidad_product, 
            url_img:product.img_product, 
            number_facture : this.number_facture,
          });

        },

        addAdditional(servicie){
              // console.log(additional);
          this.listAdditional.push({
            additional_id : servicie.id,
            name_additional:servicie.name_servicie,
            price_additional:servicie.price_servicie,
            description_additional:servicie.description_servicie,
            total:servicie.price_servicie,
          });

        },
        deleteProduct(product){
           var index =  this.listProduct.indexOf(product);
           this.listProduct.splice(index,1);

        },
        deleteAddition(additional){
            // console.log(additional);
           var index =  this.listAdditional.indexOf(additional);
           this.listAdditional.splice(index,1);

        },

        updateCustomers(page,search,valor){

                let me = this;
                var url = 'customers/update?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.put(url,{

                            'id' : this.client_id,
                            'cedula_client' :    this.cedula_client,
                            'name_client' :    this.name_client,
                            'firstSurname_client' :   this.firstSurname_client,
                            'secondSurname_client'    : this.secondSurname_client,
                            'birth_date_client'    : this.birth_date_client,
                            'gender_client'    : this.gender_client,
                            'age_client'    : this.age_client,
                            'address_client'    : this.address_client,
                            'city_client'    : this.city_client,
                            'nationality_client'    : this.nationality_client,
                            'state_client'    : this.state_client,
                            'phone_client'    : this.phone_client,
                            'email_client'    : this.email_client,


                })
                  .catch(function (error) {
                       var respuesta = error.response.data;
                       me.arrayError = respuesta.errors;
                       console.log(error.response.data);
                  });

        },


        updateRoom(page,search,valor){
                let me = this;
                var url = 'room/update?page=' + page + '&search='+ search + "&valor=" + valor;
                axios.put(url,{

                            'id' : this.habitacion_id,
                            'type_id' :    this.type_id,
                            'number' :   this.number,
                            'price'    : this.price,
                            'price_air'    : this.price_air,
                            'frozen'    : this.frozen,
                            'state'    : this.state,


                }).then(function (response) {
                      Swal.fire({
                      position: 'center',
                      icon: 'success',
                      title: 'Habitación Actualizada con Éxito',
                      showConfirmButton: false,
                      timer: 1500
                    });
                      me.closeModal('modal');
                  })
                  .catch(function (error) {
                       var respuesta = error.response.data;
                       me.arrayError = respuesta.errors;
                       console.log(error.response.data);
                  });

            },

        selectAll(){
            var items=document.getElementsByClassName('prueba');
            for(var i=0; i<items.length; i++){
              if(items[i].type=='checkbox')
                items[i].checked=true;
                this.check=this.listSales;
            }
        },

        selectAllAdditional(){
          var items=document.getElementsByClassName('additional2');
          for(var i=0; i<items.length; i++){
            if(items[i].type=='checkbox')
              items[i].checked=true;
              this.check2=this.listAdditional;
          }
        }

        },

      mounted() {
        this.listRoomsActive(1,this.search,this.valor);
        this.listEvent();
    }
  }
</script>

<style>

    .modal-content{
    width:100% ! important;
    position:  absolute ! important;
    }
    .mostrar{
    display:  list-item ! important;
    opacity:  1 ! important;
    position:  absolute ! important;
    background-color: #3c29297a !important;
    }

    .disponible{
      border: 1px solid rgb(33, 136, 56);
      /* border: 1px solid #e0e5ec;  */
      border-radius: 5%;
      color:rgb(33, 136, 56) ;
      box-shadow: 8px 8px 16px rgba(165,177,198, 0.8),
	    -8px -8px 16px rgba(255,255,255,0.8);
      -webkit-transition: all .3s ease;
      -moz-transition: all .3s ease;
      -ms-transition: all .3s ease;
      -o-transition: all .3s ease;
      transition: all .3s ease;
    }


    .disponible i{
      font-size: 45px;
      color:rgb(33, 136, 56) ;
    }

    .disponible h3{
      font-size: 24px;
      color:rgb(33, 136, 56) ;
    }

    .disponible:hover{
      background-color: rgba(15, 225, 61, 0.4) ;
      color: #000;
      transform: scaleY(1.05);
    }

    .disponible:hover h3{
      color: #000;
    }

    .disponible:hover i{
      color:#000 ;
    }
    .row_rooms a{
      text-decoration: none;
    }


    .Ocupada{
      border: 1px solid rgba(177, 32, 32, 0.859) ;
      /* border: 1px solid #e0e5ec;  */
      border-radius: 5%;
      color:rgba(177, 32, 32, 0.859) ;
      box-shadow: 8px 8px 16px rgba(165,177,198, 0.8),
	    -8px -8px 16px rgba(255,255,255,0.8);
      -webkit-transition: all .3s ease;
      -moz-transition: all .3s ease;
      -ms-transition: all .3s ease;
      -o-transition: all .3s ease;
      transition: all .3s ease;
    }

    .Ocupada i{
      font-size: 45px;
      color:rgba(177, 32, 32, 0.859);
    }

    .Ocupada h3{
      font-size: 24px;
      color:rgba(177, 32, 32, 0.859);
    }

     .Ocupada:hover{
      background-color:rgba(177, 32, 32, 0.571) ;
      color: #000;
      transform: scaleY(1.1);
    }

    .Ocupada:hover i{
      color:#000 ;
    }

    .Ocupada:hover h3{
      color: #000;
    }

    .certificate label {
       font-size: 30px;
       padding-right: 10px;
    }
    .certificate h2{
       color: rgb(235, 23, 23);
       font-size: 40px;
    }

    .form_certificate{
      overflow: auto;
    }

    .imgProduct{
    width: 60px;
    height: 60px;
    }

    .product_img .imgProduct{
        width: 100%;
    }

    .img_products{
        width: 100px;
        height: 100px;
    }

    .imgProduct img{
        width: 100%;
    }

    .calendar{
      width: 100%;
      height: 400px;
    }

    .reservation{
      margin-top: 400px;
    }

    .btn-floatiing {
        display: inline-block;
        color: rgb(14, 236, 62);
        position: relative;
        overflow: hidden;
        z-index: 1;
        width: 30px;
        height: 30px;
        line-height: 30px;
        padding: 0;
        background-color: #5a1aee;
        border-radius: 50%;
        -webkit-transition: background-color .3s;
        transition: background-color .3s;
        cursor: pointer;
        vertical-align: middle;
        box-shadow: 0 1px 10px
        rgba(0, 0, 0, 0.4);
    }

    .btn-floatiing i {
        width: 50%;
        height: 80%;
        display: inline-block;
        text-align: center;
        color: #eee;
        font-size: 1rem;
        line-height: 20px;
    }
    .btn-add {
        display: inline-block;
        color: rgb(14, 236, 62);
        position: relative;
        overflow: hidden;
        z-index: 1;
        width: 30px;
        height: 30px;
        line-height: 30px;
        padding: 0;
        background-color: #5a1aee;
        border-radius: 50%;
        -webkit-transition: background-color .3s;
        transition: background-color .3s;
        cursor: pointer;
        vertical-align: middle;
        box-shadow: 0 1px 10px
        rgba(0, 0, 0, 0.4);
    }

    .btn-add i {
        width: 50%;
        height: 80%;
        display: inline-block;
        text-align: center;
        color: #eee;
        font-size: 1rem;
        line-height: 20px;
    }
    .loader {
  color:rgb(0, 128, 128);
  font-size: 20px;
  margin: 100px auto;
  width: 1em;
  height: 1em;
  border-radius: 50%;
  position: relative;
  text-indent: -9999em;
  -webkit-animation: load4 1.3s infinite linear;
  animation: load4 1.3s infinite linear;
  -webkit-transform: translateZ(0);
  -ms-transform: translateZ(0);
  transform: translateZ(0);
    }
    @-webkit-keyframes load4 {
      0%,
      100% {
        box-shadow: 0 -3em 0 0.2em, 2em -2em 0 0em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 0;
      }
      12.5% {
        box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em, 3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
      }
      25% {
        box-shadow: 0 -3em 0 -0.5em, 2em -2em 0 0, 3em 0 0 0.2em, 2em 2em 0 0, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
      }
      37.5% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em, -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
      }
      50% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em, -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
      }
      62.5% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0, -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
      }
      75% {
        box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
      }
      87.5% {
        box-shadow: 0em -3em 0 0, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
      }
    }
    @keyframes load4 {
      0%,
      100% {
        box-shadow: 0 -3em 0 0.2em, 2em -2em 0 0em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 0;
      }
      12.5% {
        box-shadow: 0 -3em 0 0, 2em -2em 0 0.2em, 3em 0 0 0, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
      }
      25% {
        box-shadow: 0 -3em 0 -0.5em, 2em -2em 0 0, 3em 0 0 0.2em, 2em 2em 0 0, 0 3em 0 -1em, -2em 2em 0 -1em, -3em 0 0 -1em, -2em -2em 0 -1em;
      }
      37.5% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 0, 2em 2em 0 0.2em, 0 3em 0 0em, -2em 2em 0 -1em, -3em 0em 0 -1em, -2em -2em 0 -1em;
      }
      50% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 0em, 0 3em 0 0.2em, -2em 2em 0 0, -3em 0em 0 -1em, -2em -2em 0 -1em;
      }
      62.5% {
        box-shadow: 0 -3em 0 -1em, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 0, -2em 2em 0 0.2em, -3em 0 0 0, -2em -2em 0 -1em;
      }
      75% {
        box-shadow: 0em -3em 0 -1em, 2em -2em 0 -1em, 3em 0em 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0.2em, -2em -2em 0 0;
      }
      87.5% {
        box-shadow: 0em -3em 0 0, 2em -2em 0 -1em, 3em 0 0 -1em, 2em 2em 0 -1em, 0 3em 0 -1em, -2em 2em 0 0, -3em 0em 0 0, -2em -2em 0 0.2em;
      }
    }

</style>