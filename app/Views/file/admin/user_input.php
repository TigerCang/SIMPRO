<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= lang('app.bgDetil') ?>">
                    <h5><?= lang('app.detildata') ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= ($user[0]->is_aktif == '0' ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" id="idatasan" name="idatasan" value="<= $user[0]->atasan_id ?>">
                    <input type="hidden" class="form-control" id="limitatasan" name="limitatasan" value="<?= $useratas[0]->batasacc ?? '0' ?>">
                    <div class="form-group row">
                        <label for="kode" class="col-sm-1 col-form-label"><?= lang('app.username') ?></label>
                        <div class="col-sm-4">
                            <input type="text" readonly class="form-control" id="kode" name="kode" maxlength="50" placeholder="<?= lang('app.min3kar') ?>" value="<?= $user[0]->kode ?>">
                        </div>
                        <div class="col-sm-3"></div>
                        <label for="peminta" class="col-sm-1 col-form-label"><?= lang('app.peminta') ?></label>
                        <div class="col-sm-3">
                            <input type="text" readonly class="form-control" id="peminta" name="peminta" value="<?= $user[0]->peminta ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="role" class="col-sm-1 col-form-label"><?= lang('app.role') ?></label>
                        <div class="col-sm-4">
                            <select id="role" class="js-example-basic-single" name="role">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($role as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= ($user[0]->role_id == $db->id ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errrole"></div>
                        </div>
                        <div class="col-sm-3"></div>
                        <label for="level" class="col-sm-1 col-form-label"><?= lang('app.setuju') ?></label>
                        <div class="col-sm-3">
                            <select id="level" class="js-example-basic-single" name="level">
                                <option value="" <?= ($user[0]->acc_setuju == '' ? 'selected' : '') ?>><?= lang('app.pilih-') ?></option>
                                <?php for ($i = 1; $i <= $level[0]['nilai']; $i++) : ?>
                                    <?php $deskripsi = ($i == '1' ? ' (' . lang('app.tinggi') . ')' : ($i == $level[0]['nilai'] ? ' (' . lang('app.rendah') . ')' : '')) ?>
                                    <option value="<?= $i ?>" <?= ($user[0]->acc_setuju == $i ? 'selected' : '') . ($menu == 'auser' ? ($useratas[0]->acc_setuju != '0' ? (($useratas[0]->acc_setuju <= $i || $i == '0') ? '' : ($user[0]->acc_setuju <= $i ? '' : 'disabled')) : ($i == '0' ? '' : 'disabled')) : '') ?>><?= $i . ' => Level ' . $i . $deskripsi ?></option>
                                <?php endfor ?>
                                <option value="0">----------------------------------</option>
                                <option value="101" <?= ($user[0]->acc_setuju == '101' ? 'selected' : '') . ($menu == 'auser' ? ($useratas[0]->act_setuju == '101' ? '' : ($user[0]->act_setuju == '101' ? '' : 'disabled')) : '') ?>>101 => <?= lang('app.keuangan') ?> 1</option>
                                <option value="102" <?= ($user[0]->acc_setuju == '102' ? 'selected' : '') . ($menu == 'auser' ? ($useratas[0]->act_setuju == '102' ? '' : ($user[0]->act_setuju == '102' ? '' : 'disabled')) : '') ?>>102 => <?= lang('app.keuangan') ?> 2</option>
                            </select>
                            <div id="error" class="invalid-feedback d-block errlevel"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="atasan" class="col-sm-1 col-form-label"><?= lang('app.atasan') ?></label>
                        <div class="col-sm-4">
                            <select id="atasan" class="js-example-data-ajax" name="atasan" <?php ($menu == 'auser' ? ($user[0]->atasan_id != '0' ? 'disabled' : '') : '') ?>>
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if ($user1) : ?><option value="<?= $user1[0]->id ?>" selected><?= "{$user1[0]->kode} : {$user1[0]->namapeg}" ?></option><?php endif; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block erratasan"></div>
                        </div>
                        <div class="col-sm-4"></div>
                        <label for="nibatas" class="col-sm-1 col-form-label"><?= lang('app.batassetuju') ?></label>
                        <div class="col-sm-2">
                            <input type="text" class="form-control form-control-right autonumber" data-digit-after-decimal="2" data-a-sep="." data-a-dec="," id="nibatas" name="nibatas" value="<?= $user[0]->batasacc ?>">
                            <div id="error" class="invalid-feedback errnibatas"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-1">&nbsp;</div>
                    </div>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label"><?= lang('app.aksi') ?></label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="create" name="create" <?= ($menu == 'auser' && $useratas[0]->act_create == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_create == '1' ? 'checked' : '') ?> data-on="<?= lang('app.create') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="primary" data-offstyle="light">
                        </div>
                        <div class="col-sm-1">
                            <input type="checkbox" id="edit" name="edit" <?= ($menu == 'auser' && $useratas[0]->act_edit == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_edit == '1' ? 'checked' : '') ?> data-on="<?= lang('app.update') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="warning" data-offstyle="light">
                        </div>
                        <div class="col-sm-1">
                            <input type="checkbox" id="pasti" name="pasti" <?= ($menu == 'auser' && $useratas[0]->act_confirm == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_confirm == '1' ? 'checked' : '') ?> data-on="<?= lang('app.pasti') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="success" data-offstyle="light">
                        </div>
                        <div class="col-sm-1">
                            <input type="checkbox" id="hapus" name="hapus" <?= ($menu == 'auser' && $useratas[0]->act_delete == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_delete == '1' ? 'checked' : '') ?> data-on="<?= lang('app.hapus') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="danger" data-offstyle="light">
                        </div>
                        <div class="col-sm-1">
                            <input type="checkbox" id="aktif" name="aktif" <?= ($menu == 'auser' && $useratas[0]->act_aktif == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_aktif == '1' ? 'checked' : '') ?> data-on="<?= lang('app.aktif') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="info" data-offstyle="light">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label"><?= lang('app.akses') ?></label>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-1 col-form-label"><?= lang('app.perusahaan') ?></label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="perusahaan" name="perusahaan" <?= ($menu == 'auser' && $useratas[0]->act_perusahaan == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_perusahaan == '1' ? 'checked' : '') ?> data-on="<?= lang('app.semua') ?>" data-off="<?= lang('app.pilihan') ?>" data-onstyle="primary" data-offstyle="warning">
                        </div>
                        <div class="col-sm-2"></div>
                        <label class="col-sm-1 col-form-label"><?= lang('app.camp') ?></label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="camp" name="camp" <?= ($menu == 'auser' && $useratas[0]->act_camp == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_camp == '1' ? 'checked' : '') ?> data-on="<?= lang('app.semua') ?>" data-off="<?= lang('app.pilihan') ?>" data-onstyle="primary" data-offstyle="warning">
                        </div>
                        <div class="col-sm-2"></div>
                        <label class="col-sm-1 col-form-label"><?= lang('app.atasan') ?></label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="super" name="super" <?= ($menu == 'auser' && $useratas[0]->act_super == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_super == '1' ? 'checked' : '') ?> data-on="<?= lang('app.atasan') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="danger" data-offstyle="light">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-1 col-form-label"><?= lang('app.wilayah') ?></label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="wilayah" name="wilayah" <?= ($menu == 'auser' && $useratas[0]->act_wilayah == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_wilayah == '1' ? 'checked' : '') ?> data-on="<?= lang('app.semua') ?>" data-off="<?= lang('app.pilihan') ?>" data-onstyle="primary" data-offstyle="warning">
                        </div>
                        <div class="col-sm-2"></div>
                        <label class="col-sm-1 col-form-label"><?= lang('app.proyek') ?></label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="proyek" name="proyek" <?= ($menu == 'auser' && $useratas[0]->act_proyek == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_proyek == '1' ? 'checked' : '') ?> data-on="<?= lang('app.semua') ?>" data-off="<?= lang('app.pilihan') ?>" data-onstyle="primary" data-offstyle="warning">
                        </div>
                        <div class="col-sm-2"></div>
                        <label class="col-sm-1 col-form-label" <?= ($menu == 'auser' ? 'hidden' : '') ?>><?= lang('app.filter') ?></label>
                        <div class="col-sm-1" <?= ($menu == 'auser' ? 'hidden' : '') ?>>
                            <input type="checkbox" id="saring" name="saring" data-toggle="toggle" <?= ($user[0]->act_saring == '1' ? 'checked' : '') ?> data-on="<?= lang('app.tbh+') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="danger" data-offstyle="light">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-1 col-form-label"><?= lang('app.divisi') ?></label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="divisi" name="divisi" <?= ($menu == 'auser' && $useratas[0]->act_divisi == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_divisi == '1' ? 'checked' : '') ?> data-on="<?= lang('app.semua') ?>" data-off="<?= lang('app.pilihan') ?>" data-onstyle="primary" data-offstyle="warning">
                        </div>
                        <div class="col-sm-2"></div>
                        <label class="col-sm-1 col-form-label"><?= lang('app.alat') . ' & ' . lang('app.tool') ?></label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="alat" name="alat" <?= ($menu == 'auser' && $useratas[0]->act_alat == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_alat == '1' ? 'checked' : '') ?> data-on="<?= lang('app.semua') ?>" data-off="<?= lang('app.pilihan') ?>" data-onstyle="primary" data-offstyle="warning">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-1"></div>
                        <label class="col-sm-1 col-form-label"><?= lang('app.gaji') ?></label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="gaji" name="gaji" <?= ($menu == 'auser' && $useratas[0]->act_gaji == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_gaji == '1' ? 'checked' : '') ?> data-on="<?= lang('app.semua') ?>" data-off="<?= lang('app.pilihan') ?>" data-onstyle="primary" data-offstyle="warning">
                        </div>
                        <div class="col-sm-2"></div>
                        <label class="col-sm-1 col-form-label"><?= lang('app.tanah') ?></label>
                        <div class="col-sm-1">
                            <input type="checkbox" id="tanah" name="tanah" <?= ($menu == 'auser' && $useratas[0]->act_tanah == '0' ? 'disabled' : '') ?> data-toggle="toggle" <?= ($user[0]->act_tanah == '1' ? 'checked' : '') ?> data-on="<?= lang('app.semua') ?>" data-off="<?= lang('app.pilihan') ?>" data-onstyle="primary" data-offstyle="warning">
                        </div>
                    </div>
                    <br />
                    <div class="form-group row">
                        <label class="col-sm-1 col-form-label"><?= lang('app.pilihan') ?></label>
                        <div class="col-sm-11">
                            <div class="j-tabs-container">
                                <input id="tab1" type="radio" name="tabs" checked="" />
                                <label class="j-tabs-label" for="tab1" title="nperusahaan"><span><?= lang('app.perusahaan') ?></span></label>
                                <input id="tab2" type="radio" name="tabs" />
                                <label class="j-tabs-label" for="tab2" title="nwilayah"><span><?= lang('app.wilayah') ?></span></label>
                                <input id="tab3" type="radio" name="tabs" />
                                <label class="j-tabs-label" for="tab3" title="ndivisi"><span><?= lang('app.divisi') ?></span></label>
                                <input id="tab4" type="radio" name="tabs" />
                                <label class="j-tabs-label" for="tab4" title="ngaji"><span><?= lang('app.gaji') ?></span></label>
                                <input id="tab5" type="radio" name="tabs" />
                                <label class="j-tabs-label" for="tab5" title="ncamp"><span><?= lang('app.camp') ?></span></label>
                                <input id="tab6" type="radio" name="tabs" />
                                <label class="j-tabs-label" for="tab6" title="nproyek"><span><?= lang('app.proyek') ?></span></label>
                                <input id="tab7" type="radio" name="tabs" />
                                <label class="j-tabs-label" for="tab7" title="nalat"><span><?= lang('app.alat') . ' & ' . lang('app.tool') ?></span></label>
                                <input id="tab8" type="radio" name="tabs" />
                                <label class="j-tabs-label" for="tab8" title="ntanah"><span><?= lang('app.tanah') ?></span></label>
                                <input id="tab9" type="radio" name="tabs" />
                                <label class="j-tabs-label" for="tab9" title="nkas"><span><?= lang('app.kasbank') ?></span></label>
                                <!--  -->
                                <div id="tabs-section-1" class="j-tabs-section">
                                    <div class="j-forms">
                                        <div class="content">
                                            <?php $perus = (explode(",", $user[0]->perusahaan)) ?>
                                            <select id="custom-headers" class="searchable" multiple="multiple" name="dafperusahaan[]">
                                                <?php foreach ($perusahaan as $db) : $kondisi = '';
                                                    foreach ($perus as $field) if ($field == $db->id) $kondisi = 'selected' ?>
                                                    <option value="<?= $db->id ?>" <?= ($kondisi . ($menu == 'auser' ? ($useratas[0]->act_perusahaan == '0' ? (preg_match("/(^|,)" . $db->id . "(,|$)/i", $useratas[0]->perusahaan) ? '' : 'disabled') : '') : '')) ?>><?= "{$db->kode} => {$db->nama}" ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabs-section-2" class="j-tabs-section">
                                    <div class="j-forms">
                                        <div class="content">
                                            <?php $wil = (explode(",", $user[0]->wilayah)) ?>
                                            <select id="custom-headers" class="searchable" multiple="multiple" name="dafwilayah[]">
                                                <?php foreach ($wilayah as $db) : $kondisi = '';
                                                    foreach ($wil as $field) if ($field == $db->id) $kondisi = 'selected' ?>
                                                    <option value="<?= $db->id ?>" <?= ($kondisi . ($menu == 'auser' ? ($useratas[0]->act_wilayah == '0' ? (preg_match("/(^|,)" . $db->id . "(,|$)/i", $useratas[0]->wilayah) ? '' : (preg_match("/(^|,)" . $db->id . "(,|$)/i", $user[0]->wilayah) ? '' : 'disabled')) : '') : '')) ?>><?= $db->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabs-section-3" class="j-tabs-section">
                                    <div class="j-forms">
                                        <div class="content">
                                            <?php $div = (explode(",", $user[0]->divisi)) ?>
                                            <select id="custom-headers" class="searchable" multiple="multiple" name="dafdivisi[]">
                                                <?php foreach ($divisi as $db) : $kondisi = '';
                                                    foreach ($div as $field) if ($field == $db->id) $kondisi = 'selected' ?>
                                                    <option value="<?= $db->id ?>" <?= ($kondisi . ($menu == 'auser' ? ($useratas[0]->act_divisi == '0' ? (preg_match("/(^|,)" . $db->id . "(,|$)/i", $useratas[0]->divisi) ? '' : 'disabled') : '') : '')) ?>><?= $db->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabs-section-4" class="j-tabs-section">
                                    <div class="j-forms">
                                        <div class="content">
                                            <?php $jabat = (explode(",", $user[0]->gaji)) ?>
                                            <select id="custom-headers" class="searchable" multiple="multiple" name="dafjabatan[]">
                                                <?php foreach ($jabatan as $db) : $kondisi = '';
                                                    foreach ($jabat as $field) if ($field == $db->id) $kondisi = 'selected' ?>
                                                    <option value="<?= $db->id ?>" <?= ($kondisi . ($menu == 'auser' ? ($useratas[0]->act_gaji == '0' ? (preg_match("/(^|,)" . $db->id . "(,|$)/i", $useratas[0]->gaji) ? '' : 'disabled') : '') : '')) ?>><?= $db->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabs-section-5" class="j-tabs-section">
                                    <div class="j-forms">
                                        <div class="content">
                                            <?php $cam = (explode(",", $user[0]->camp)) ?>
                                            <select id="custom-headers" class="searchable" multiple="multiple" name="dafcamp[]">
                                                <?php foreach ($camp as $db) : $kondisi = '';
                                                    foreach ($cam as $field) if ($field == $db->id) $kondisi = 'selected' ?>
                                                    <option value="<?= $db->id ?>" <?= ($kondisi . ($menu == 'auser' ? ($useratas[0]->act_camp == '0' ? (preg_match("/(^|,)" . $db->id . "(,|$)/i", $useratas[0]->camp) ? '' : 'disabled') : '') : '')) ?>><?= "{$db->kode} => {$db->nama}" ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabs-section-6" class="j-tabs-section">
                                    <div class="j-forms">
                                        <div class="content">
                                            <?php $proy = (explode(",", $user[0]->proyek)) ?>
                                            <select id="custom-headers" class="searchable" multiple="multiple" name="dafproyek[]">
                                                <?php foreach ($proyek as $db) : $kondisi = '';
                                                    foreach ($proy as $field) if ($field == $db->id) $kondisi = 'selected' ?>
                                                    <option value="<?= $db->id ?>" <?= ($kondisi . ($menu == 'auser' ? ($useratas[0]->act_proyek == '0' ? (preg_match("/(^|,)" . $db->id . "(,|$)/i", $useratas[0]->proyek) ? '' : 'disabled') : '') : '')) ?>><?= "{$db->kode} => {$db->paket}" ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabs-section-7" class="j-tabs-section">
                                    <div class="j-forms">
                                        <div class="content">
                                            <?php $alt = (explode(",", $user[0]->alat)) ?>
                                            <select id="custom-headers" class="searchable" multiple="multiple" name="dafalat[]">
                                                <?php foreach ($alat as $db) : $kondisi = '';
                                                    foreach ($alt as $field) if ($field == $db->id) $kondisi = 'selected' ?>
                                                    <option value="<?= $db->id ?>" <?= ($kondisi . ($menu == 'auser' ? ($useratas[0]->act_alat == '0' ? (preg_match("/(^|,)" . $db->id . "(,|$)/i", $useratas[0]->alat) ? '' : 'disabled') : '') : '')) ?>><?= "{$db->kode} => {$db->nama}" ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabs-section-8" class="j-tabs-section">
                                    <div class="j-forms">
                                        <div class="content">
                                            <?php $tan = (explode(",", $user[0]->tanah)) ?>
                                            <select id="custom-headers" class="searchable" multiple="multiple" name="daftanah[]">
                                                <?php foreach ($tanah as $db) : $kondisi = '';
                                                    foreach ($tan as $field) if ($field == $db->id) $kondisi = 'selected' ?>
                                                    <option value="<?= $db->id ?>" <?= ($kondisi . ($menu == 'auser' ? ($useratas[0]->act_tanah == '0' ? (preg_match("/(^|,)" . $db->id . "(,|$)/i", $useratas[0]->tanah) ? '' : 'disabled') : '') : '')) ?>><?= "{$db->kode} => {$db->nama}" ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div id="tabs-section-9" class="j-tabs-section">
                                    <div class="j-forms">
                                        <div class="content">
                                            <?php $kas = (explode(",", $user[0]->jenis_kas)) ?>
                                            <select id="custom-headers" class="searchable" multiple="multiple" name="dafkas[]">
                                                <?php foreach ($kasbank as $db) : $kondisi = '';
                                                    foreach ($kas as $field) if ($field == $db->id) $kondisi = 'selected' ?>
                                                    <option value="<?= $db->id ?>" <?= ($kondisi . ($menu == 'auser' ? (preg_match("/(^|,)" . $db->id . "(,|$)/i", $useratas[0]->jenis_kas) ? '' : 'disabled') : '')) ?>><?= $db->nama ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div></div>
                        <div>
                            <button type="button" name="action" value="aktif" class="btn <?= $btnclas2 ?> btnsave" <?= $actaktif ?>><?= $btntext2 ?></button>
                            <button type="button" name="action" value="confirm" class="btn <?= lang('app.btncConfirm') ?> btnsave" <?= $btnsama . $actconf ?>><?= lang('app.btnConfirm') ?></button>
                            <button type="button" class="btn <?= lang('app.btncDelete') ?> btndel" <?= $btnhapus ?> onclick="hapus('<?= $idunik ?>')" <?= $actcreate ?>><?= lang('app.btnDelete') ?></button>
                            <button type="button" name="action" value="save" class="btn <?= $btnclas1 ?> btnsave" <?= $actcreate ?>><?= $btntext1 ?></button>
                            <!-- <= "<button type='button' name='action' value='aktif' class='btn " . $btnclas2 . " btnsave' $actaktif>" . $btntext2 . "</button>
                                <button type='button' name='action' value='confirm' class='btn " . lang('app.btncConfirm') . " btnsave' $btnsama $actconf>" . lang('app.btnConfirm') . "</button>                           
                                <button type='button' class='btn " . lang('app.btncDelete') . " btndel' $btnhapus onclick='hapus(\"$idunik\")' $actcreate>" . lang('app.btnDelete') . "</button>         
                                <button type='button' name='action' value='save' class='btn " . $btnclas1 . " btnsave' $actcreate>" . $btntext1 . "</button>"; ?> -->
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.upby") . ' : ' . ($user[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.confby") . ' : ' . ($user[0]->coby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.acby") . ' : ' . ($user[0]->akby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
    <?= form_close() ?>
</div><!-- body end -->

<script>
    $("#atasan").on("change", () => $("#idatasan").val($("#atasan").val()));

    function hapus(idunik) {
        var url = '/user/delete';
        Swal.fire({
            title: '<?= lang('app.tanyadel'); ?>',
            text: "<?= lang('app.infodel'); ?>",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '<?= lang('app.confirmdel'); ?>',
            cancelButtonText: '<?= lang('app.batal'); ?>'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    type: 'post',
                    url: url,
                    data: {
                        idunik: idunik
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.redirect) {
                            window.location.href = response.redirect;
                        }
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status + "\n" + xhr.responseText);
                        alert(thrownError);
                    }
                });
            }
        })
    }

    $(document).ready(function() {
        $("#atasan").select2({
            ajax: {
                url: "/<?= $menu ?>/atasan",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                    };
                },
                processResults: function(response) {
                    return {
                        results: response
                    };
                },
                cache: true
            },
            <?= lang("app.inputminimum") ?>,
        });

        $('.btnsave').click(function(e) {
            e.preventDefault();
            var form = $('.formfile')[0];
            var formData = new FormData(form);
            var getAction = $(this).val();
            var url = '/<?= $menu ?>/save';
            formData.append('postaction', getAction);
            $.ajax({
                type: 'post',
                url: url,
                data: formData,
                cache: false,
                processData: false,
                contentType: false,
                dataType: "json",
                beforeSend: function() {
                    $('.btnsave').attr('disabled', 'disabled');
                    $('.btnsave').html('<i class="fa fa-spin fa-spinner"></i>');
                },
                complete: function() {
                    $('.btnsave').removeAttr('disabled');
                    $('.btnsave').each(function() {
                        var value = $(this).val();
                        if (value === 'aktif') {
                            $(this).html('<?= $btntext2 ?>');
                        } else if (value === 'confirm') {
                            $(this).html('<?= lang("app.btnConfirm") ?>');
                        } else if (value === 'save') {
                            $(this).html('<?= $btntext1 ?>');
                        }
                        $(this).attr('name', 'action');
                    });
                },
                success: function(response) {
                    $('#atasan, #nibatas, #setuju, #role').removeClass('is-invalid');
                    $('.erratasan, .errnibatas, .errsetuju, .errrole').html('');
                    if (response.error) {
                        handleFieldError('atasan', response.error.atasan);
                        handleFieldError('nibatas', response.error.nibatas);
                        handleFieldError('setuju', response.error.setuju);
                        handleFieldError('role', response.error.role);
                    } else {
                        window.location.href = response.redirect;
                    }

                    function handleFieldError(field, error) {
                        if (error) {
                            $('#' + field).addClass('is-invalid');
                            $('.err' + field).html(error);
                        } else {
                            $('#' + field).removeClass('is-invalid');
                        }
                    }
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText);
                    alert(thrownError);
                }
            });
            return false;
        })
    });
</script>

<?= $this->endSection() ?>