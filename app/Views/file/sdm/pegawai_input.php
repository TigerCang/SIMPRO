<?= $this->extend('layout/template') ?>
<?= $this->section('content') ?>

<div class="page-body">
    <?= form_open('', ['class' => 'formfile']) ?>
    <?= csrf_field() ?>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($pegawai ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= ($pegawai ? lang('app.detildata') : lang('app.inputdata')) ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <input type="hidden" class="form-control" name="idunik" value="<?= $idunik ?>">
                    <input type="hidden" class="form-control" id="niaktif" name="niaktif" value="<?= (($pegawai && $pegawai[0]->is_aktif == '0') ? '1' : '0') ?>">
                    <input type="hidden" class="form-control" id="idperusahaan" name="idperusahaan" value="<?= ($pegawai[0]->perusahaan_id ?? '') ?>">
                    <input type="hidden" class="form-control" id="idwilayah" name="idwilayah" value="<?= ($pegawai[0]->wilayah_id ?? '') ?>">
                    <input type="hidden" class="form-control" id="iddivisi" name="iddivisi" value="<?= ($pegawai[0]->divisi_id ?? '') ?>">
                    <input type="hidden" class="form-control" id="idjabatan" name="idjabatan" value="<?= ($pegawai[0]->jabatan_id ?? '') ?>">
                    <input type="hidden" class="form-control" id="idcamp" name="idcamp" value="<?= ($pegawai[0]->cabang_id ?? '') ?>">
                    <input type="hidden" class="form-control" id="jk" name="jk" value="<?= ($pegawai[0]->jenkel ?? '') ?>">
                    <input type="hidden" class="form-control" name="gambarlama" value="<?= ($pegawai[0]->gambar ?? 'default.png') ?>">
                    <div class="form-group row">
                        <label for="kode" class="col-sm-1 col-form-label"><?= lang('app.kode') ?></label>
                        <div class="col-sm-4">
                            <input type="text" harusisi <?= (($pegawai && $pegawai[0]->is_confirm != '0') ? 'readonly' : '') ?> class="form-control text-uppercase" id="kode" name="kode" maxlength="16" placeholder="<?= lang('app.min16kar') ?>" value="<?= ($pegawai[0]->kode ?? '') ?>">
                            <div id="error" class="invalid-feedback errkode"></div>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="nip" class="col-sm-2 col-form-label"><?= lang('app.nip+') ?></label>
                        <div class="col-sm-3">
                            <input type="text" harusisi <?= (($pegawai && $pegawai[0]->is_confirm != '0') ? 'readonly' : '')  ?> class="form-control nip" id="nip" name="nip" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($pegawai[0]->nip ?? '') ?>" data-mask="99.99.9999">
                            <div id="error" class="invalid-feedback errnip"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="nama" class="col-sm-1 col-form-label"><?= lang('app.nama') ?></label>
                        <div class="col-sm-11">
                            <input type="text" harusisi class="form-control" id="nama" name="nama" placeholder="<?= lang('app.harusisi') ?>" value="<?= ($pegawai[0]->nama ?? '') ?>">
                            <div id="error" class="invalid-feedback errnama"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="perusahaan" class="col-sm-1 col-form-label"><?= lang('app.perusahaan') ?></label>
                        <div class="col-sm-11">
                            <select id="perusahaan" class="js-example-basic-single" name="perusahaan" <?= (($pegawai && $pegawai[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected><?= lang('app.pilih-') ?></option>
                                <?php foreach ($perusahaan as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($pegawai && $pegawai[0]->perusahaan_id == $db->id) ? 'selected' : '') . ($tuser['act_perusahaan'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['perusahaan']) ? '' : 'disabled') ?>><?= "{$db->kode} => {$db->nama}" ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errperusahaan"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="wilayah" class="col-sm-1 col-form-label"><?= lang('app.wilayah') ?></label>
                        <div class="col-sm-4">
                            <select id="wilayah" class="js-example-basic-single" name="wilayah" <?= (($pegawai && $pegawai[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected><?= lang('app.pilih-') ?></option>
                                <?php foreach ($wilayah as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($pegawai && $pegawai[0]->wilayah_id == $db->id) ? 'selected' : '') . ($tuser['act_wilayah'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['wilayah']) ? '' : 'disabled') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errwilayah"></div>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="divisi" class="col-sm-1 col-form-label"><?= lang('app.divisi') ?></label>
                        <div class="col-sm-4">
                            <select id="divisi" class="js-example-basic-single" name="divisi" <?= (($pegawai && $pegawai[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected><?= lang('app.pilih-') ?></option>
                                <?php foreach ($divisi as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($pegawai && $pegawai[0]->divisi_id == $db->id) ? 'selected' : '') . ($tuser['act_divisi'] == '1' || preg_match("/(^|,)" . $db->id . "(,|$)/i", $tuser['divisi']) ? '' : 'disabled') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errdivisi"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kodecamp" class="col-sm-1 col-form-label"><?= lang('app.cabang') ?></label>
                        <div class="col-sm-2">
                            <input type="text" readonly class="form-control" id="kodecamp" name="kodecamp" value="<?= ($camp1[0]->kode ?? '') ?>">
                            <div id="error" class="invalid-feedback errkodecamp"></div>
                        </div>
                        <div class="col-sm-9 input-group">
                            <input type="text" <?= ($pegawai && $pegawai[0]->is_confirm != '0' ? 'readonly' : '') ?> class="form-control" id="namacamp" name="namacamp" value="<?= ($camp1[0]->nama ?? '') ?>">
                            <span class="input-group-addon">
                                <i class="icofont <?= ($pegawai && $pegawai[0]->is_confirm != '0' ? 'icofont-link-alt' : 'icofont-search-alt-2') ?>" aria-hidden="true" <?= ($pegawai && $pegawai[0]->is_confirm != '0' ? '' : 'onclick="klikcamp()"') ?>></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="lokasi" class="col-sm-1 col-form-label"><?= lang('app.lokasi') ?></label>
                        <div class="col-sm-11">
                            <input type="text" class="form-control" id="lokasi" name="lokasi" value="<?= ($pegawai[0]->lokasi ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="t4lahir" class="col-sm-1 col-form-label"><?= lang('app.t4lahir') ?></label>
                        <div class="col-sm-6">
                            <input type="text" class="form-control" id="t4lahir" name="t4lahir" value="<?= ($pegawai[0]->t4lahir ?? '') ?>">
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="tgllahir" class="col-sm-1 col-form-label"><?= lang('app.tgllahir') ?></label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="tgllahir" name="tgllahir" value="<?= ($pegawai[0]->tgl_lahir ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jenkel" class="col-sm-1 col-form-label"><?= lang('app.jenkel') ?></label>
                        <div class="col-sm-3 form-radio">
                            <div class="radio radiofill radio-primary radio-inline">
                                <label><input type="radio" name="jenkel" value="pria" <?= (($pegawai && $pegawai[0]->jenkel == "pria") ? 'checked' : '') ?>><i class="helper"></i><?= lang('app.pria') ?></label>
                            </div>
                            <div class="radio radiofill radio-primary radio-inline">
                                <label><input type="radio" name="jenkel" value="wanita" <?= (($pegawai && $pegawai[0]->jenkel == "wanita") ? 'checked' : '') ?>><i class="helper"></i><?= lang('app.wanita') ?></label>
                            </div>
                        </div>
                        <div class="col-sm-4"></div>
                        <label for="goldarah" class="col-sm-1 col-form-label"><?= lang('app.goldarah') ?></label>
                        <div class="col-sm-3">
                            <select id="goldarah" class="js-example-basic-single" name="goldarah">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($selgd as $db) : ?>
                                    <option value="<?= $db->nama ?>" <?= (($pegawai && $pegawai[0]->goldarah == $db->nama) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alamat" class="col-sm-1 col-form-label"><?= lang('app.alamat') ?></label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="3" id="alamat" name="alamat"><?= ($pegawai[0]->alamat ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="kontak" class="col-sm-1 col-form-label"><?= lang('app.kontak') ?></label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="3" id="kontak" name="kontak"><?= ($pegawai[0]->kontak ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="surel" class="col-sm-1 col-form-label"><?= lang('app.surel') ?></label>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" id="surel" name="surel" value="<?= ($pegawai[0]->email ?? '') ?>">
                        </div>
                        <label class="col-sm-2 col-form-label text-right"><?= lang('app.osm') ?></label>
                        <div class="col-sm-1 text-right"><input type="checkbox" id="osm" name="osm" data-toggle="toggle" <?= (($pegawai && $pegawai[0]->osm == '1') ? 'checked' : '') ?> data-on="<?= lang('app.ya') ?>" data-off="<?= lang('app.no') ?>" data-onstyle="success" data-offstyle="light"></div>
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
    <div class="row">
        <div class="col-sm-9">

            <div class="card">
                <div class="card-header <?= ($pegawai ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= lang('app.idkontrak') ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="form-group row">
                        <label for="jsim" class="col-sm-2 col-form-label"><?= lang('app.sim') ?></label>
                        <div class="col-sm-3">
                            <select id="jsim" class="js-example-basic-single" name="jsim">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($selkelsim as $db1) : ?>
                                    <optgroup label="<?= $db1->kelompok ?>">
                                        <?php foreach ($selsim as $db) : ?>
                                            <?php if ($db->kelompok == $db1->kelompok) : ?> <option value="<?= $db->nama ?>" <?= (($pegawai && $pegawai[0]->jns_sim == $db->nama) ? 'selected' : '') ?>><?= $db->nama ?></option><?php endif; ?>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="nosim" class="col-sm-2 col-form-label"><?= lang('app.nomor') ?></label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="nosim" name="nosim" value="<?= ($pegawai[0]->nosim ?? '') ?>" />
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-6"></div>
                        <label for="tglsim" class="col-sm-2 col-form-label"><?= lang('app.tanggalhabis') ?></label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="tglsim" name="tglsim" value="<?= ($pegawai[0]->tgl_sim ?? '') ?>">
                        </div>
                    </div>
                    <hr>
                    <div class="form-group row">
                        <label for="ijazah" class="col-sm-2 col-form-label"><?= lang('app.ijazah') ?></label>
                        <div class="col-sm-3">
                            <select id="ijazah" class="js-example-basic-single" name="ijazah">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($selijasah as $db) : ?>
                                    <option value="<?= $db->nama ?>" <?= (($pegawai && $pegawai[0]->ijasah == $db->nama) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="jurusan" class="col-sm-2 col-form-label"><?= lang('app.jurusan') ?></label>
                        <div class="col-sm-4">
                            <select id="jurusan" class="js-example-tokenizer" name="jurusan">
                                <option value=""><?= lang('app.pilihcr') ?></option>
                                <?php foreach ($jurusan as $db) : ?>
                                    <option value="<?= $db->jurusan ?>" <?= (($pegawai && $pegawai[0]->jurusan == $db->jurusan) ? 'selected' : '') ?>><?= $db->jurusan ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="statusijazah" class="col-sm-2 col-form-label"><?= lang('app.status') ?></label>
                        <div class="col-sm-3">
                            <select id="statusijazah" class="js-example-basic-single" name="statusijazah">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($selstatijasah as $db) : ?>
                                    <option value="<?= $db->nama ?>" <?= (($pegawai && $pegawai[0]->st_ijasah == $db->nama) ? 'selected' : '') ?>><?= lang('app.' . $db->nama) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="tglijazah" class="col-sm-2 col-form-label"><?= lang('app.tanggal') ?></label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="tglijazah" name="tglijazah" value="<?= ($pegawai[0]->tgl_ijasah ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="statuspeg" class="col-sm-2 col-form-label"><?= lang('app.status') ?></label>
                        <div class="col-sm-3">
                            <select id="statuspeg" class="js-example-basic-single" name="statuspeg">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($selstatpegawai as $db) : ?>
                                    <option value="<?= $db->nama ?>" <?= (($pegawai && $pegawai[0]->st_pegawai == $db->nama) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="tgljoin" class="col-sm-2 col-form-label"><?= lang('app.tglgabung') ?></label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="tgljoin" name="tgljoin" value="<?= ($pegawai[0]->tgl_join ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="tglawal" class="col-sm-2 col-form-label"><?= lang('app.awalkontrak') ?></label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="tglawal" name="tglawal" value="<?= ($pegawai[0]->tgl_kontrakawal ?? '') ?>">
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="tglakhir" class="col-sm-2 col-form-label"><?= lang('app.akhirkontrak') ?></label>
                        <div class="col-sm-3">
                            <input type="date" class="form-control" id="tglakhir" name="tglakhir" value="<?= ($pegawai[0]->tgl_kontrakakhir ?? '') ?>">
                        </div>
                    </div>
                </div>
            </div> <!-- Akhir card -->

        </div>
        <div class="col-sm-3">

            <div class="card">
                <div class="card-header <?= ($pegawai ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= lang('app.gambar') ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <img src="/assets/fileimg/pegawai/<?= ($pegawai[0]->gambar ?? 'default.png') ?>" class="img-thumbnail img-preview mx-auto my-auto d-block">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-12">
                            <input type="file" class="form-control" id="gambar" name="gambar" onchange="previewImage()" />
                            <div id="error" class="invalid-feedback errgambar"></div>
                        </div>
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($pegawai ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= lang('app.keluarperusahaan') ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="form-group row">
                        <label for="modkeluar" class="col-sm-1 col-form-label"><?= lang('app.keluarperusahaan') ?></label>
                        <div class="col-sm-3">
                            <select id="modkeluar" class="js-example-basic-single" name="modkeluar">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($selmodkeluar as $db) : ?>
                                    <option value="<?= $db->nama ?>" <?= (($pegawai && $pegawai[0]->mode_keluar == $db->nama) ? 'selected' : '') ?>><?= lang('app.' . $db->nama) ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="col-sm-1"></div>
                        <label for="tglkeluar" class="col-sm-1 col-form-label"><?= lang('app.tanggal') ?></label>
                        <div class="col-sm-2">
                            <input type="date" class="form-control" id="tglkeluar" name="tglkeluar" value="<? ($pegawai[0]->tgl_keluar ?? '') ?>">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="alasan" class="col-sm-1 col-form-label"><?= lang('app.alasan') ?></label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="3" id="alasan" name="alasan"><?= ($pegawai[0]->alasan_keluar ?? '') ?></textarea>
                        </div>
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">

            <div class="card">
                <div class="card-header <?= ($pegawai ? lang('app.bgDetil') : lang('app.bgInput')) ?>">
                    <h5><?= lang('app.data+') ?></h5>
                    <div class="card-header-right">
                        <ul class="list-unstyled card-option">
                            <li><i class="feather icon-chevrons-down minimize-card"></i></li>
                        </ul>
                    </div>
                </div>
                <!--  -->
                <div class="card-block mt-2">
                    <div class="form-group row">
                        <label for="kelakun" class="col-sm-1 col-form-label"><?= lang('app.kelakun') ?></label>
                        <div class="col-sm-11">
                            <select id="kelakun" class="js-example-basic-single" name="kelakun">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($kelakun as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($pegawai && $pegawai[0]->kakun_peg == $db->id) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errkelakun"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="jabatan" class="col-sm-1 col-form-label"><?= lang('app.jabatan') ?></label>
                        <div class="col-sm-4">
                            <select id="jabatan" class="js-example-basic-single" name="jabatan" <?= (($pegawai && $pegawai[0]->is_confirm != '0') ? 'disabled' : '') ?>>
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($jabatan as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($pegawai && $pegawai[0]->jabatan_id == $db->id) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errjabatan"></div>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="golongan" class="col-sm-1 col-form-label"><?= lang('app.golpeg') ?></label>
                        <div class="col-sm-4">
                            <select id="golongan" class="js-example-basic-single" name="golongan">
                                <option value="" selected disabled><?= lang('app.pilih-') ?></option>
                                <?php foreach ($golongan as $db) : ?>
                                    <option value="<?= $db->id ?>" <?= (($pegawai && $pegawai[0]->golongan_id == $db->id) ? 'selected' : '') ?>><?= $db->nama ?></option>
                                <?php endforeach; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block errgolongan"></div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="userid" class="col-sm-1 col-form-label"><?= lang('app.username') ?></label>
                        <div class="col-sm-4">
                            <select id="userid" class="js-example-data-ajax" name="userid">
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if ($user1) : ?> <option value="<?= $user1[0]->id ?>" selected><?= "{$user1[0]->kode} : {$user1[0]->namapeg}" ?></option><?php endif; ?>
                            </select>
                            <div id="error" class="invalid-feedback d-block erruserid"></div>
                        </div>
                        <div class="col-sm-2"></div>
                        <label for="statusptkp" class="col-sm-1 col-form-label"><?= lang('app.ptkp') ?></label>
                        <div class="col-sm-4">
                            <select id="statusptkp" class="js-example-basic-single" name="statusptkp">
                                <option value=""><?= lang('app.pilih-') ?></option>
                                <?php foreach ($selkelptkp as $db1) : ?>
                                    <optgroup label="<?= $db1->kelompok ?>">
                                        <?php foreach ($selptkp as $db) : ?>
                                            <?php if ($db->kelompok == $db1->kelompok) : ?> <option value="<?= $db->nama ?>" <?= (($pegawai && $pegawai[0]->st_ptkp == $db->nama) ? 'selected' : '') ?>><?= $db->nama ?></option><?php endif; ?>
                                        <?php endforeach; ?>
                                    </optgroup>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="atasan" class="col-sm-1 col-form-label"><?= lang('app.atasan') ?></label>
                        <div class="col-sm-11">
                            <select id="atasan" class="js-example-data-ajax" name="atasan">
                                <option value=""><?= lang('app.pilihsr') ?></option>
                                <?php if ($pegawai1) : ?> <option value="<?= $pegawai1[0]->id ?>" selected><?= "{$pegawai1[0]->kode} => {$pegawai1[0]->nama}" ?></option><?php endif; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="asuransi" class="col-sm-1 col-form-label"><?= lang('app.asuransi') ?></label>
                        <div class="col-sm-11">
                            <textarea class="form-control" rows="3" id="asuransi" name="asuransi"><?= ($pegawai[0]->asuransi ?? '') ?></textarea>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="catatan" class="col-sm-1 col-form-label"><?= lang('app.catatan') ?></label>
                        <div class="col-sm-11">
                            <textarea harusisi class="form-control" rows="3" id="catatan" name="catatan" placeholder="<?= lang('app.harusisi') ?>"><?= ($pegawai[0]->catatan ?? '') ?></textarea>
                            <div id="error" class="invalid-feedback errcatatan"></div>
                        </div>
                    </div>
                </div>
                <!--  -->
                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <div>
                            <button type="button" class="btn <?= lang('app.btncLampir') . $actcreate ?> tambahlampiran" <?= $btnlam ?>><?= lang('app.btnLampir') ?></button>
                        </div>
                        <div>
                            <button type="reset" class="btn <?= lang('app.btncReset') ?>" <?= $btnhid ?>><?= lang('app.btnReset') ?></button>
                            <button type="button" name="action" value="aktif" class="btn <?= $btnclas2 ?> btnsave" <?= $actaktif ?>><?= $btntext2 ?></button>
                            <button type="button" name="action" value="confirm" class="btn <?= lang('app.btncConfirm') ?> btnsave" <?= $btnsama . $actconf ?>><?= lang('app.btnConfirm') ?></button>
                            <button type="button" name="action" value="save" class="btn <?= $btnclas1 ?> btnsave" <?= $actcreate ?>><?= $btntext1 ?></button>
                        </div>
                    </div>
                    <div class="d-flex">
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline">
                                    <span><?= lang("app.upby") . ' : ' . ($pegawai[0]->upby ?? '') ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline"><span><?= lang("app.confby") . ' : ' . ($pegawai[0]->coby ?? '') ?></span></div>
                            </div>
                        </div>
                        <div class="col-3">
                            <div class="page-header-title">
                                <div class="d-inline"><span><?= lang("app.acby") . ' : ' . ($pegawai[0]->akby ?? '') ?></span></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- Akhir card -->

        </div>
    </div>
    <?= form_close() ?>
    <div class="row" <?= ($pegawai ? '' : 'hidden') ?>>
        <div class="col-sm-12">
            <div class="dt-responsive table-responsive tabellampiran"></div>
        </div>
    </div>
</div><!-- body end -->
<div class="modallampiran" style="display: none;"></div>

<script>
    $("#perusahaan").on("change", () => $("#idperusahaan").val($("#perusahaan").val()));
    $("#divisi").on("change", () => $("#iddivisi").val($("#divisi").val()));
    $("#wilayah").on("change", () => $("#idwilayah").val($("#wilayah").val()));
    $("#jabatan").on("change", () => $("#idjabatan").val($("#jabatan").val()));

    function klikcamp() {
        var getPerusahaan = $("#perusahaan").val();
        var getWilayah = $("#wilayah").val();
        var getDivisi = $("#divisi").val();
        var getNama = $("#namacamp").val();
        $.ajax({
            url: "/pegawai/basecamp",
            data: {
                perusahaan: getPerusahaan,
                wilayah: getWilayah,
                divisi: getDivisi,
                isi: getNama,
                wenbrako: '10000001',
            },
            dataType: "json",
            success: function(response) {
                $('.modallampiran').html(response.data).show();
                $('#modal-lampiran').modal('show')
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText);
                alert(thrownError);
            }
        });
    }

    function datalampiran() {
        var getIDU = "<?= $idunik ?>";
        $.ajax({
            url: "/pegawai/tablampir",
            data: {
                idunik: getIDU,
                xpilih: 'pegawai',
            },
            dataType: "json",
            success: function(response) {
                $('.tabellampiran').html(response.data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status + "\n" + xhr.responseText);
                alert(thrownError);
            }
        });
    }

    $(document).ready(function() {
        datalampiran();

        $('input[type="radio"]').click(function() {
            var inputValue = $(this).attr("value");
            document.getElementById('jk').value = inputValue;
        });

        $('.tambahlampiran').click(function(e) {
            e.preventDefault();
            var getIDU = "<?= $idunik ?>";
            $.ajax({
                url: "/pegawai/modallampir",
                data: {
                    idunik: getIDU,
                    xpilih: 'pegawai',
                },
                dataType: "json",
                success: function(response) {
                    $('.modallampiran').html(response.data).show();
                    $('#modal-lampiran').modal('show')
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    alert(xhr.status + "\n" + xhr.responseText);
                    alert(thrownError);
                }
            });
        })

        $("#atasan").select2({
            ajax: {
                url: "/pegawai/pegawai",
                type: "post",
                dataType: "json",
                delay: 250,
                data: function(params) {
                    return {
                        searchTerm: params.term,
                        pilih: '0001',
                        osm: '0',
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

        $("#userid").select2({
            ajax: {
                url: "/pegawai/user",
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
            var url = '/pegawai/save';
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
                    $('#kode, #nama, #nip, #perusahaan, #wilayah, #divisi, #kodecamp, #kelakun, #golongan, #jabatan, #gambar, #userid, #catatan').removeClass('is-invalid');
                    $('.errkode, .errnama, .errnip, .errperusahaan, .errwilayah, .errdivisi, .errkodecamp, .errkelakun, .errgolongan, .errjabatan, .errgambar, .erruserid, .errcatatan').html('');
                    if (response.error) {
                        handleFieldError('kode', response.error.kode);
                        handleFieldError('nama', response.error.nama);
                        handleFieldError('nip', response.error.nip);
                        handleFieldError('perusahaan', response.error.perusahaan);
                        handleFieldError('wilayah', response.error.wilayah);
                        handleFieldError('divisi', response.error.divisi);
                        handleFieldError('kodecamp', response.error.kodecamp);
                        handleFieldError('kelakun', response.error.kelakun);
                        handleFieldError('golongan', response.error.golongan);
                        handleFieldError('jabatan', response.error.jabatan);
                        handleFieldError('gambar', response.error.gambar);
                        handleFieldError('userid', response.error.userid);
                        handleFieldError('catatan', response.error.catatan);
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