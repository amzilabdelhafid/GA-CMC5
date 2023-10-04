function genererCode()
{
	let chars = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXTZabcdefghiklmnopqrstuvwxyz";
	let string_length = 10;
	let randomstring = '';
	for (let i = 0; i < string_length; i++)
	{
		let rnum = Math.floor(Math.random() * chars.length);
		randomstring += chars.substring(rnum, rnum + 1);
	}
	
	$('#cod_rpan').val(randomstring);
}

function tauxConversion(start, end)
{

}


function nouvellesCommandes(start, end)
{
	$("#nouvellesCommandes").html('<div class="kt-spinner kt-spinner--md kt-spinner--danger"></div>');
	$.ajax({
		type: "POST",
		url: "0-req/req.commandeNouvellesCommandes.php",
		data: "start=" + start + "&end=" + end,
		dataType: 'HTML',
		success: function (data) {
			$("#nouvellesCommandes").html(data);
		}
	});
}


function nouveauxClients(start, end)
{
	$("#nouveauxClients").html('<div class="kt-spinner kt-spinner--md kt-spinner--success"></div>');
	$.ajax({
		type: "POST",
		url: "0-req/req.commandeNouveauxClients.php",
		data: "start=" + start + "&end=" + end,
		dataType: 'HTML',
		success: function (data) {
			$("#nouveauxClients").html(data);
		}
	});
}


function valeurMoyenne(start, end)
{
	$("#valeurMoyenne").html('<div class="kt-spinner kt-spinner--md kt-spinner--warning"></div>');
	$.ajax({
		type: "POST",
		url: "0-req/req.commandeValeurMoyenne.php",
		data: "start=" + start + "&end=" + end,
		dataType: 'HTML',
		success: function (data) {
			$("#valeurMoyenne").html(data + " €");
		}
	});
}

function valeurTotale(start, end)
{
	$("#valeurTotale").html('<div class="kt-spinner kt-spinner--md kt-spinner--brand"></div>');
	$.ajax({
		type: "POST",
		url: "0-req/req.commandeValeurTotale.php",
		data: "start=" + start + "&end=" + end,
		dataType: 'HTML',
		success: function (data) {
			$("#valeurTotale").html(data + " €");
		}
	});
}


function ouvrirReception(id_doce)
{
	$("#modal").modal("show");
	$("#modal .modal-title").html("Réceptionner une commande");
	$("#modal .modal-body").html("");
	$.ajax({
		type: "POST",
		url: "0-vue/modal/vue.reception.php",
		data: "id_doce=" + id_doce,
		dataType: 'HTML',
		success: function (content) {
			$("#modal .modal-body").html(content);
		}
	});
	$("#modal .modal-footer").html(`
		<button type="button" class="btn btn-sm btn-primary justify-self-start" onclick="toutReceptionner();">
			<i class="fa fa-check-double"></i>		
			<span class="kt-hidden-mobile">Tout réceptionner</span>
		</button>
		<button type="button" class="btn btn-sm btn-primary" id="btn-trans-submit" onclick="validerModal('reception');">
			<i class="fa fa-check"></i>
			<span class="kt-hidden-mobile">Enregistrer</span>
		</button>
		<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
	`);
}

function ouvrirSuivi(id_doce)
{
	$("#modal").modal("show");
	$("#modal .modal-title").html("Ajouter un n° de suivi");
	$("#modal .modal-body").html("");
	$.ajax({
		type: "POST",
		url: "0-vue/modal/vue.suivi.php",
		data: "id_doce=" + id_doce,
		dataType: 'HTML',
		success: function (content) {
			$("#modal .modal-body").html(content);
		}
	});
	$("#modal .modal-footer").html(`<button type="button" class="btn btn-sm btn-primary" id="btn-trans-submit" onclick="validerModal('suivi');"><i class="la la-check"></i><span class="kt-hidden-mobile">Enregistrer</span></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>`);
}

function ouvrirImporterPort()
{
	$("#modal").modal("show");
	$("#modal .modal-title").html("Importer une grille de frais de port");
	$("#modal .modal-body").html("");
	$.ajax({
		type: "POST", url: "0-vue/modal/vue.importerPort.php", // data: "id_doce="+id_doce,
		dataType: 'HTML', success: function (content) {
			$("#modal .modal-body").html(content);
		}
	});
	$("#modal .modal-footer").html(`<button type="button" class="btn btn-sm btn-primary" id="btn-port-submit" onclick="importerPort()" disabled><i class="la la-check"></i><span class="kt-hidden-mobile">Enregistrer</span></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>`);
}


function ouvrirHistorique(id_doce)
{
	$("#modal").modal("show");
	$("#modal .modal-title").html("Historique du document");
	$("#modal .modal-body").html("");
	$.ajax({
		type: "POST",
		url: "0-vue/modal/vue.historique.php",
		data: "id_doce=" + id_doce,
		dataType: 'HTML',
		success: function (content) {
			$("#modal .modal-body").html(content);
		}
	});
	$("#modal .modal-footer").html(`</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>`);
}


function ouvrirReglement(id_doce)
{
	$("#modal").modal("show");
	$("#modal .modal-title").html("Ajouter un règlement");
	$("#modal .modal-body").html("");
	$.ajax({
		type: "POST",
		url: "0-vue/modal/vue.reglement.php",
		data: "id_doce=" + id_doce,
		dataType: 'HTML',
		success: function (content) {
			$("#modal .modal-body").html(content);
		}
	});
	$("#modal .modal-footer").html(`<button type="button" class="btn btn-sm btn-primary" id="btn-trans-submit" onclick="validerModal('reglement');"><i class="la la-check"></i><span class="kt-hidden-mobile">Enregistrer</span></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>`);
}


function ouvrirTransformer(id_doce, typ_doce)
{
	$("#modal").modal("show");
	$("#modal .modal-title").html("Transformer mon document");
	$("#modal .modal-body").html("");
	$.ajax({
		type: "POST",
		url: "0-vue/modal/vue.transformer.php",
		data: "id_doce=" + id_doce + "&typ_doce=" + typ_doce,
		dataType: 'HTML',
		success: function (content) {
			$("#modal .modal-body").html(content);
		}
	});
	$("#modal .modal-footer").html(`<button type="button" class="btn btn-sm btn-primary" id="btn-trans-submit" onclick="validerModal('transformer');" disabled><i class="la la-check"></i><span class="kt-hidden-mobile">Enregistrer</span></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>`);
}


function ouvrirAdresse(id_adresse)
{
	let id_client = $("input[name=id_client]").val();
	$("#modal").modal("show");
	$("#modal .modal-title").html("Modification de l'adresse");
	$("#modal .modal-body").html("");
	$.ajax({
		type: "POST",
		url: "0-req/req.adresseGet.php",
		data: "id_adresse=" + id_adresse,
		dataType: 'JSON',
		success: function (data) {
			$.ajax({
				type: "POST",
				url: "0-vue/modal/vue.adresse.php",
				data: "adresse=" + JSON.stringify(data) + "&id_client=" + id_client,
				dataType: 'HTML',
				success: function (content) {
					$("#modal .modal-body").html(content);
				}
			});
		}
	});
	$("#modal .modal-footer").html(`<button type="button" class="btn btn-sm btn-primary" onclick="validerModal('adresse');"><i class="la la-check"></i><span class="kt-hidden-mobile">Enregistrer</span></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>`);
}

function ouvrirClient(id_client)
{
	$("#modal").modal("show");
	if(id_client)
	{
	   $("#modal .modal-title").html("Modification des informations de facturation");
	}
	else
	{
			$("#modal .modal-title").html("Ajout d'un nouveau client");
	}
	
	$("#modal .modal-body").html("");
	$.ajax({
		type: "POST",
		url: "0-req/req.clientGet.php",
		data: "id_client=" + id_client,
		dataType: 'JSON',
		success: function (data) {
			$.ajax({
				type: "POST",
				url: "0-vue/modal/vue.client.php",
				data: "client=" + JSON.stringify(data),
				dataType: 'HTML',
				success: function (content) {
					$("#modal .modal-body").html(content);
				}
			});
		}
	});
	$("#modal .modal-footer").html(`<button type="button" class="btn btn-sm btn-primary" onclick="validerModal('client');"><i class="la la-check"></i><span class="kt-hidden-mobile">Enregistrer</span></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>`);
}

function ouvrirReappro(produitList)
{
	$("#modal").modal("show");
	$("#modal .modal-title").html("Saisir un délais");
	$("#modal .modal-body").html("");
	$.ajax({
		type: "POST",
		url: "0-vue/modal/vue.reappro.php",
		data: "produitList=" + produitList,
		dataType: 'HTML',
		success: function (content) {
			$("#modal .modal-body").html(content);
		}
	});
	$("#modal .modal-footer").html(`<button id="valider" type="button" class="btn btn-sm btn-primary"><i class="la la-check"></i><span class="kt-hidden-mobile">Enregistrer</span></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>`);
}

function ouvrirUtilisateurDroit(id_profil)
{
	$("#modal").modal("show");
	$("#modal .modal-title").html("Sélectionner les utilisateurs dont les droits seront modifiés");
	$("#modal .modal-body").html("");

	$.ajax({
		type: "POST",
		url: "0-vue/modal/vue.utilisateurDroit.php",
		data: "id_profil=" + id_profil,
		dataType: 'HTML',
		success: function (content) {
			$("#modal .modal-body").html(content);
		}
	});

	$("#modal .modal-footer").html(`<button type="button" class="btn btn-sm btn-primary" id="btn-trans-submit" onclick="validerModal('utilisateur_module');">
																		<i class="la la-check"></i>
																		<span class="kt-hidden-mobile">Enregistrer</span>
																	</button>
																	<button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
	`);
}

function ouvrirExporterCmd(typ_doce)
{
	$("#modal").modal("show");
	$("#modal .modal-title").html("Exporter les commandes ");
	$("#modal .modal-body").html("");
	$.ajax({
		type: "POST",
		url: "0-vue/modal/vue.exporterCmd.php",
		data: "typ_doce=" + typ_doce,
		dataType: 'HTML',
		success: function (content) {
			$("#modal .modal-body").html(content);
		}
	});
	$("#modal .modal-footer").html(`<button type="button" class="btn btn-sm btn-primary" id="btn-trans-submit" onclick="exporterCmd();"><i class="fas fa-file-import"></i><span class="kt-hidden-mobile">Exporter</span></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>`);
}

function ouvrirImprimerFacture()
{
	$("#modal").modal("show");
	$("#modal .modal-title").html("Imprimer les Factures ");
	$("#modal .modal-body").html("");
	$.ajax({
		type: "POST", url: "0-vue/modal/vue.imprimerFacture.php", dataType: 'HTML', success: function (content) {
			$("#modal .modal-body").html(content);
		}
	});
	$("#modal .modal-footer").html(`<button type="button" class="btn btn-sm btn-primary" id="btn-trans-submit" onclick="imprimerFacture();"><i class="fas fa-file-import"></i><span class="kt-hidden-mobile">Imprimer</span></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>`);
}

function imprimerFacture()
{
	$('#saisie_date_error').addClass('hidden');
	$('#saisie_date_error').html('');
	
	let from = $("#dat_doce_debut").val();
	from = from.split("/");
	from = from[1] + "/" + from[0] + "/" + from[2];
	from = new Date(from).getTime();
	
	let to = $("#dat_doce_fin").val();
	to = to.split("/");
	to = to[1] + "/" + to[0] + "/" + to[2];
	to = new Date(to).getTime();
	
	if ($("#dat_doce_debut").val() == '' || $("#dat_doce_fin").val() == '')
	{
		$('#saisie_date_error').removeClass('hidden');
		$('#saisie_date_error').append('Erreur: Les champs dates sont obligatoires');
		return;
	}
	
	if (from > to)
	{
		$('#saisie_date_error').removeClass('hidden');
		$('#saisie_date_error').append('Erreur: la date début doit être inférieure à la date de fin');
		
	}
	else
	{
		let form = $("#modal-form");
		
		$.ajax({
			type: "POST",
			url: "0-req/req.imprimerFacture.php",
			cache: false,
			data: new FormData(form[0]),
			processData: false,
			contentType: false,
			dataType: 'JSON',
			success: function (data) {
				
				if (data.type === 'success')
				{
					window.open(data.fichier, '_blank');
				}
				else
				{
					toastr.error(data.msg);
				}
				
				
			}
		});
	}
}

function exporterCmd()
{
	
	let from = $("#dat_doce_debut").val();
	from = from.split("/");
	from = from[1] + "/" + from[0] + "/" + from[2];
	from = new Date(from).getTime();
	
	let to = $("#dat_doce_fin").val();
	to = to.split("/");
	to = to[1] + "/" + to[0] + "/" + to[2];
	to = new Date(to).getTime();
	
	
	if (from > to)
	{
		toastr.error('Invalid Date Range');
	}
	else
	{
		let form = $("#modal-form");
		
		$.ajax({
			type: "POST",
			url: "0-req/req.exporterCmd.php",
			cache: false,
			data: new FormData(form[0]),
			processData: false,
			contentType: false,
			dataType: 'HTML',
			success: function (data) {
				window.open(data, '_blank');
			}
		});
	}
	
	
}

function ouvrirImporterProduit()
{
	$("#modal").modal("show");
	$("#modal .modal-title").html("Importer Liste de produits");
	$("#modal .modal-body").html("");
	$.ajax({
		type: "POST", url: "0-vue/modal/vue.importerProduit.php", 
		dataType: 'HTML', success: function (content) {
			$("#modal .modal-body").html(content);
		}
	});
	$("#modal .modal-footer").html(`<button type="button" class="btn btn-sm btn-primary" id="btn-port-submit" onclick="validerImport();" disabled><i class="la la-check"></i><span class="kt-hidden-mobile">Enregistrer</span></button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>`);
}

function validerModal(table)
{
	if (table != 'reception')
	{
		let form = $("#modal-form");
		$.ajax({
			type: "POST",
			url: "0-req/req." + table + "Save.php",
			cache: false,
			data: new FormData(form[0]),
			processData: false,
			contentType: false,
			dataType: 'JSON',
			success: function (data) {
				
				$("#modal").modal("hide");
				
				if (table == "transformer")
				{
					if (data.sta == 0)
					{
						// redirection vers le document en saisie
						switch(data.typ)
						{
							case 1:
								getContent('./commande/add/' + data.id, true);
								break;

							case 2:
								getContent('./preparation/add/' + data.id, true);
								break;

							case 3:
								getContent('./livraison/add/' + data.id, true);
								break;

							case 7:
								getContent('./expedition/add/' + data.id, true);
								break;

							case 13:
								getContent('./commandedirect/add/' + data.id, true);
								break;
						}
					}
					else
					{
						// si j'ai créé un BL je génére aussi la facture si la facture n'existe pas encore
						if (data.typ == 3 && data.facture == 0)
						{
							$.ajax({
								type: "POST",
								url: "0-req/req." + table + "Save.php?id_doce=" + data.id + "&typ_doce=6&sta_doce=2",
								cache: false,
								processData: false,
								contentType: false,
								dataType: 'JSON',
								success: function (data2) {
									if (data2.type === 'success')
									{
										toastr.success(data2.msg);
										loadAPI('./livraison');
										setTimeout(() => ouvrirSuivi(data.id), 900);
									}
									else
									{
										toastr.error(data2.msg);
									}
								}
							});
						}
						
						// getContent('./livraison');
						// setTimeout(function () {
						// 	ouvrirSuivi(data.id)
						// }, 900);
					}
					
					if (data.type === 'success')
					{
						toastr.success(data.msg);
					}
					else
					{
						toastr.error(data.msg);
					}
				}
				
				if (table == "reglement" || table == "importerPort" || table == "suivi" || table == "reappro")
				{
					$("#table_ajax, #table_ajax1").DataTable().ajax.reload();
					if (data.type === 'success')
					{
						toastr.success(data.msg);
					}
					else
					{
						toastr.error(data.msg);
					}
				}
				
				if (table == "adresse")
				{
					refreshSelectAdresse(data.objet.id_client, data.id);
				}
				
				if (table == "client")
				{
					getClient(data.id);
				}
				if (table == "utilisateur_module")
				{
					if (data.type === 'success')
					{
						toastr.success(data.msg);
					}
					else
					{
						toastr.error(data.msg);
					}
				}
			}
		});
	}
	else
	{
		validerReception();
	}
}

// $('#modal-form').submit();


function getContent(url, addEntry)
{
	$.post(url, {method: "post"}).done(function (data) {
		// Updating Content on Page
		$('#contentHolder').html(data);
		if (addEntry == true)
		{
			// Add History Entry using pushState
			history.pushState(null, null, url);
		}
	});
}

function loadAPI(href)
{
	getContent(href, true);
}

function ajouterLigne()
{
	if ($('.line:hidden:first').length > 0)
	{
		let line = $('.line:hidden:first').attr('id');
		let i = $('.line:hidden:first').data('line');
		$('#' + line).css('display', 'table-row');
		return i;
	}
}


// function AddLinePort() { 
// 	if ($('.line:hidden:first').length > 0) {
// 		// let line = $('.line:hidden:first').attr('id');
// 		let i = $('.line:hidden:first').data('line');
// 		alert(i);
// 		$('line_' + i).css('display', 'table-row');
// 		return i;
// 	}
// }

function ajouterLigneDiv()
{
	if ($('.line:hidden:first').length > 0)
	{
		let line = $('.line:hidden:first').attr('id');
		let i = $('.line:hidden:first').data('line');
		$('#' + line).css('display', 'flex');
		
		return i;
	}
}

// Fonction retournant un datatable type pour les js List
// AJOUTER order à la fin
function creerDatatable(reqPath, columnsList, tableName, inOrder, initFunction, columnDefs, options = {})
{
	
	let tableElement = $('#' + tableName);
	
	let table = tableElement.DataTable({
		dom: `<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
		bStateSave: false,
		responsive: true,
		searchDelay: 500,
		processing: true,
		serverSide: true,
		bSortCellsTop: true,
		orderMulti: false,
		destroy: true,
		ajax: (data, callback) => {
			$.ajax({
				type: "POST",
				url: reqPath,
				data: data,
				dataType: 'JSON',
				success: response => {
					if (response.type === 'error')
					{
						toastr.error(response.msg);
						return;
					}
					
					callback(response);
				}
			});
		},
		columns: columnsList,
		order: inOrder,
		language: {
			processing: "Traitement en cours...",
			search: "Rechercher&nbsp;:",
			lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ment(s)",
			info: "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ment(s)",
			infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ment(s)",
			infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ment(s) au total)",
			infoPostFix: "",
			loadingRecords: "Chargement en cours...",
			zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
			emptyTable: "Aucune donn&eacute;e disponible dans le tableau",
			paginate: {
				first: "Premier", previous: "Pr&eacute;c&eacute;dent", next: "Suivant", last: "Dernier"
			},
			aria: {
				sortAscending: ": activer pour trier la colonne par ordre croissant",
				sortDescending: ": activer pour trier la colonne par ordre décroissant"
			}
		},
		columnDefs: columnDefs,
		initComplete: function () {
			tableElement.find("#dataSearch").on('click', e => {
				e.preventDefault();
				let params = {};
				let type = {};
				let i = 0;
				
				if (options.searchOffset !== undefined)
				{
					 i = options.searchOffset;
				}
				
				tableElement.find(".filterRow").find('.filter').each(function () {
					if (params[i])
					{
						params[i] += '|' + $(this).val();
					}
					else
					{
						params[i] = $(this).val();
						type[i] = $(this).data("type");
					}
					i++;
				});
				$.each(params, function (i, val) {
					table.column(i).search(val ? val : '', false, false);
				});
				table.ajax.reload();
			});
			
			tableElement.find("#dataReset").on('click', function (e) {
				e.preventDefault();
				let j = 0;
				tableElement.find('.filterRow').find('.filter').each(() => {
					$(this).val('');
					table.column(j).search('', false, false);
					j++;
				});
				
				table.ajax.reload();
			});
			
			tableElement.find(".filter").on('change', () => {
				tableElement.find("#dataSearch").click();
			});
		},
		"drawCallback": () => {
			if (isFunction(initFunction))
			{
				initFunction();
			}
		}
	});
	
	
	
	return table;
}

// Fonction retournant un datatable type pour les js List
// AJOUTER order à la fin
function creerDatatable2(reqPath, columnsList, tableName, inOrder, initFunction, columnDefs, options = {})
{
	
	let tableElement = $('#' + tableName);
	
	let table = tableElement.DataTable({
		dom: `<'row'<'col-sm-12'tr>>
			<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7 dataTables_pager'lp>>`,
		bStateSave: false,
		responsive: true,
		searchDelay: 500,
		processing: true,
		serverSide: true,
		bSortCellsTop: false,
		bInfo: false,
		paging: false,
		orderMulti: false,
		destroy: true,
		paging: false,
		ajax: (data, callback) => {
			$.ajax({
				type: "POST",
				url: reqPath,
				data: data,
				dataType: 'JSON',
				success: response => {
					if (response.type === 'error')
					{
						toastr.error(response.msg);
						return;
					}
					
					callback(response);
				}
			});
		},
		columns: columnsList,
		order: inOrder,
		language: {
			processing: "Traitement en cours...",
			search: "Rechercher&nbsp;:",
			lengthMenu: "Afficher _MENU_ &eacute;l&eacute;ment(s)",
			info: "Affichage de l'&eacute;l&eacute;ment _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ment(s)",
			infoEmpty: "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ment(s)",
			infoFiltered: "(filtr&eacute; de _MAX_ &eacute;l&eacute;ment(s) au total)",
			infoPostFix: "",
			loadingRecords: "Chargement en cours...",
			zeroRecords: "Aucun &eacute;l&eacute;ment &agrave; afficher",
			emptyTable: "Aucune donn&eacute;e disponible dans le tableau",
			paginate: {
				first: "Premier", previous: "Pr&eacute;c&eacute;dent", next: "Suivant", last: "Dernier"
			},
			aria: {
				sortAscending: ": activer pour trier la colonne par ordre croissant",
				sortDescending: ": activer pour trier la colonne par ordre décroissant"
			}
		},
		columnDefs: columnDefs,
		initComplete: function () {
			tableElement.find("#dataSearch").on('click', e => {
				e.preventDefault();
				let params = {};
				let type = {};
				let i = 0;
				
				if (options.searchOffset !== undefined)
				{
					 i = options.searchOffset;
				}
				
				tableElement.find(".filterRow").find('.filter').each(function () {
					if (params[i])
					{
						params[i] += '|' + $(this).val();
					}
					else
					{
						params[i] = $(this).val();
						type[i] = $(this).data("type");
					}
					i++;
				});
				$.each(params, function (i, val) {
					table.column(i).search(val ? val : '', false, false);
				});
				table.ajax.reload();
			});
			
			tableElement.find("#dataReset").on('click', function (e) {
				e.preventDefault();
				let j = 0;
				tableElement.find('.filterRow').find('.filter').each(() => {
					$(this).val('');
					table.column(j).search('', false, false);
					j++;
				});
				
				table.ajax.reload();
			});
			
			tableElement.find(".filter").on('change', () => {
				tableElement.find("#dataSearch").click();
			});
		},
		"drawCallback": () => {
			if (isFunction(initFunction))
			{
				initFunction();
			}
		}
	});
	
	
	
	return table;
}


/**
 * Générateur de dropzone pour uploader des fichiers (ou le spécialiser en gestion d'images seulement)
 *
 * @param url Url vers le back-end qui traitera les opérations liées aux fichiers
 * @param element Element DOM qui affichera le DropZone
 * @param entite Nom de l'entité pour laquelle on génère le DropZone (ex: marque, produit, categorie, etc..)
 * @param id_entite Identifiant de l'entité
 * @param options Objet pouvant contenir les champs suivants:
 *  * type: type MIME des fichiers acceptés
 *  * maxFiles: Le nombre maximum de fichiers que l'on peut uploader
 *  * cropImage: Booléen permettant de spécifier si on veut traiter l'image (cropping, zoom) avant de l'envoyer
 *
 * @returns Renvoie l'objet DropZone
 */
function creerDropzone(url, element, entite, id_entite, options)
{
	return element.dropzone({
		url: url + "?operation=upload&id_" + entite + "=" + id_entite,
		acceptedFiles: options.type,
		autoProcessQueue: false,
		createImageThumbnails: true,
		parallelUploads: 1,
		addRemoveLinks: true,
		maxFiles: options.maxFiles,
		transformFile: function (file, done) {
			if (options.cropImage)
			{
				let that = this;  // Référence vers l'objet dropZone utile lorsque l'on change de contexte (voir code plus bas)
				
				let editor = document.createElement('div');
				editor.style.position = 'fixed';
				editor.style.left = 0;
				editor.style.right = 0;
				editor.style.top = 0;
				editor.style.bottom = 0;
				editor.style.zIndex = 9999;
				editor.style.backgroundColor = '#000000CF';
				document.body.appendChild(editor);
				
				let buttonConfirm = document.createElement('button');
				buttonConfirm.style.position = 'absolute';
				buttonConfirm.style.right = '10px';
				buttonConfirm.style.top = '10px';
				buttonConfirm.style.zIndex = 9999;
				buttonConfirm.textContent = 'Valider';
				buttonConfirm.className = 'btn btn-sm btn-primary';
				editor.appendChild(buttonConfirm);
				
				buttonConfirm.addEventListener('click', function () {
					croppie.result({
						type: 'blob'
					}).then(function (blob) {
						that.createThumbnail(blob, that.options.thumbnailWidth, that.options.thumbnailHeight, that.options.thumbnailMethod, false, function (dataURL) {
							that.emit('thumbnail', file, dataURL);
							done(blob);
						});
					});
					
					editor.parentNode.removeChild(editor);
				});
				
				let croppie = new Croppie(editor, {
					enableResize: true,
					enableZoom: true,
					viewport: {
						height: 250,
						width: 250,
						type: 'square'
					}
				});
				
				croppie.bind({
					url: URL.createObjectURL(file)
				});
			}
			else
			{
				done(file);
			}
		},
		init: function () {
			this.on("addedfile", file => {
				if (this.files.length > this.options.maxFiles)
				{
					toastr.error("Nombre maximum d'images atteint");
					this.removeFile(file);
				}
				else if (id_entite !== "")
				{
					// Le document existe déjà: on peut uploader les fichiers dès l'ajout
					// Timeout sinon l'upload ne se produit pas
					setTimeout(() => {
						while (this.getQueuedFiles().length > 0)
						{
							this.processQueue();
						}
					}, 150);
				}
			});
			
			this.on("removedfile", file => {
				if (file.accepted === true)
				{
					$.ajax({
						type: "GET",
						url: url,
						data: 'operation=delete&id_' + entite + '=' + id_entite,
						dataType: "json",
						success: response => {
							if (response.type === "success")
							{
								toastr.success("L'image a bien été supprimée");
							}
							else
							{
								toastr.error("Erreur lors de la suppression de l'image");
							}
						},
						error: () => {
							toastr.error("Erreur lors de la suppression de l'image");
						}
					});
				}
			});
			
			this.on("success", function (file, response) {
				response = JSON.parse(response);
				
				if (response.type === 'success')
				{
					toastr.success("Image ajoutée avec succès");
				}
				else
				{
					toastr.error(response.msg);
					file.accepted = false;
					file.previewElement.parentNode.removeChild(file.previewElement);
					this.removeFile(file);
				}
			});
			
			this.on("complete", () => {
				$(".dz-remove").html('<div class="m-t-1r"><button type="button" class="btn btn-outline-danger">Supprimer</button></div>');
			});
			
			$.ajax({
				type: "GET",
				url: url,
				data: 'operation=get&id_' + entite + '=' + id_entite,
				dataType: "json",
				success: images => {
					if (!Array.isArray(images))
					{
						if (images.type === 'error')
						{
							return;
						}
						
						images = [images];
					}
					
					images.forEach(image => {
						let mockFile = {
							name: image.name, size: image.size, type: image.mime, status: "success", processing: true, accepted: true
						};
						
						this.emit("addedfile", mockFile);
						this.emit("thumbnail", mockFile, image.path);
						this.emit("complete", mockFile);
						
						mockFile.previewElement.classList.add('dz-complete');
						
						this.files.push(mockFile);
					});
					
					$(".dz-remove").html('<div class="m-t-1r"><button type="button" class="btn btn-outline-danger">Supprimer</button></div>');
				}
			});
		},
		
		sending: (file, xhr, formData) => {
			formData.append('id_' + entite, id_entite);
		}
	});
}

let changerLangue = function () {
	let initchangerLangue = function () {
		
		$('.inputLangue.inputLangue1').show();
		
		$('.changerLangue').on('change', function (e) {
			let id_langue = $(this).val();
			
			$('.inputLangue:not(.inputLangue' + id_langue + ')').hide();
			$('.inputLangue.inputLangue' + id_langue).show();
		});
	};
	
	return {
		//main function to initiate the module
		init: function () {
			initchangerLangue();
		}
	};
}();


// let KTDemoPanel = function () {
// 	let demoPanel = KTUtil.getByID('kt_demo_panel');
// 	let offcanvas;
//
// 	let init = function () {
// 		offcanvas = new KTOffcanvas(demoPanel, {
// 			overlay: true, baseClass: 'kt-demo-panel', closeBy: 'kt_demo_panel_close', toggleBy: 'kt_demo_panel_toggle'
// 		});
//
// 		let head = KTUtil.find(demoPanel, '.kt-demo-panel__head');
// 		let body = KTUtil.find(demoPanel, '.kt-demo-panel__body');
//
// 		KTUtil.scrollInit(body, {
// 			disableForMobile: true, resetHeightOnDestroy: true, handleWindowResize: true, height: function () {
// 				let height = parseInt(KTUtil.getViewPort().height);
//
// 				if (head)
// 				{
// 					height = height - parseInt(KTUtil.actualHeight(head));
// 					height = height - parseInt(KTUtil.css(head, 'marginBottom'));
// 				}
//
// 				height = height - parseInt(KTUtil.css(demoPanel, 'paddingTop'));
// 				height = height - parseInt(KTUtil.css(demoPanel, 'paddingBottom'));
//
// 				return height;
// 			}
// 		});
//
// 		if (typeof offcanvas !== 'undefined' && offcanvas.length === 0)
// 		{
// 			offcanvas.on('hide', function () {
// 				let expires = new Date(new Date().getTime() + 60 * 60 * 1000); // expire in 60 minutes from now
// 				Cookies.set('kt_demo_panel_shown', 1, {expires: expires});
// 			});
// 		}
// 	}
//
// 	let remind = function () {
// 		if (!(encodeURI(window.location.hostname) == 'keenthemes.com' || encodeURI(window.location.hostname) == 'www.keenthemes.com'))
// 		{
// 			return;
// 		}
//
// 		setTimeout(function () {
// 			if (!Cookies.get('kt_demo_panel_shown'))
// 			{
// 				let expires = new Date(new Date().getTime() + 15 * 60 * 1000); // expire in 15 minutes from now
// 				Cookies.set('kt_demo_panel_shown', 1, {expires: expires});
// 				offcanvas.show();
// 			}
// 		}, 4000);
// 	}
//
// 	return {
// 		init: function () {
// 			init();
// 			remind();
// 		}
// 	};
// }();

/**
 * Remplace les virgules par des points et ne garde que la première occurrence du point
 * Utile pour l'insertion de valeurs numériques en base de données car elles refusent les valeurs avec virgule
 *
 * @param valeur Valeur à formater
 * @return Valeur formatée
 */
function formaterVirgule(valeur)
{
	if (typeof valeur === 'string')
	{
		let first = true;
		return valeur.replace(/[,.]/g, () => {
			if (first)
			{
				first = false;
				return '.';
			}
			else
			{
				return '';
			}
		});
	}
	else
	{
		return valeur;
	}
}

/**
 * Remplace la virgule par un point dans les input contenant l'attribut data-type="number"
 */
$('input[data-type="number"]').change(event => {
	$(event.target).val(formaterVirgule($(event.target).val()));
});

function deconnection()
{
	$.ajax({
		type: "POST", url: "0-req/req.utilisateurDeconnection.php", dataType: 'JSON', success: function (data) {
			location.reload();
		}
	});
}

function roundToTwo(num)
{
	return +(Math.round(num + "e+2") + "e-2");
}




/**
 * Équivalent JavaScript à la fonction PHP number_format
 *
 * @param number
 * @param decimals
 * @param dec_point
 * @param thousands_sep
 * @returns {string}
 */
function number_format(number, decimals, dec_point, thousands_sep)
{
	// Strip all characters but numerical ones.
	number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
	var n = !isFinite(+number) ? 0 : +number,
		prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
		sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
		dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
		s = '',
		toFixedFix = function (n, prec) {
			var k = Math.pow(10, prec);
			return '' + Math.round(n * k) / k;
		};
	// Fix for IE parseFloat(0.55).toFixed(0) = 0;
	s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
	if (s[0].length > 3)
	{
		s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
	}
	if ((s[1] || '').length < prec)
	{
		s[1] = s[1] || '';
		s[1] += new Array(prec - s[1].length + 1).join('0');
	}
	return s.join(dec);
}
