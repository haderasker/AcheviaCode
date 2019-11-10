"use strict";
// Class definition

var KTDatatableLocalSortDemo = function() {
	// Private functions

	// basic demo
	var demo = function() {

		var datatable = $('#ajax_data').KTDatatable({
			// datasource definition
			data: {
				type: 'remote',
				source: {
					read: {
						url: HREF,
						method : 'GET',
					},
				},
				pageSize: 10,
				serverPaging: true,
				serverFiltering: true,
				serverSorting: true,
			},

			// layout definition
			layout: {
				scroll: false, // enable/disable datatable scroll both horizontal and vertical when needed.
				footer: false, // display/hide footer
			},

			// column sorting
			sortable: true,

			pagination: true,

			search: {
				input: $('#generalSearch'),
			},

			// columns definition
			columns: [

				{
					field: 'name',
					title: 'Name',
                    width: 120,

				},
                {
					field: 'actionName',
					title: 'Action',
                    width: 120,

                },

                {
                    field: 'created_at',
                    title: 'Date',
                    width: 120,


                },
                // {
                //     field: 'created_at',
                //     title: 'Time',
                //     width: 120,
                // },


				// {
				// 	field: 'Status',
				// 	title: 'Status',
				// 	// callback function support for column rendering
				// 	template: function(row) {
				// 		var status = {
				// 			1: {'title': 'Pending', 'class': 'kt-badge--brand'},
				// 			2: {'title': 'Delivered', 'class': ' kt-badge--danger'},
				// 			3: {'title': 'Canceled', 'class': ' kt-badge--primary'},
				// 			4: {'title': 'Success', 'class': ' kt-badge--success'},
				// 			5: {'title': 'Info', 'class': ' kt-badge--info'},
				// 			6: {'title': 'Danger', 'class': ' kt-badge--danger'},
				// 			7: {'title': 'Warning', 'class': ' kt-badge--warning'},
				// 		};
				// 		return '<span class="kt-badge ' + status[row.Status].class + ' kt-badge--inline kt-badge--pill">' + status[row.Status].title + '</span>';
				// 	},
				// },
				],
		});

    $('#kt_form_status').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Status');
    });


    $('#kt_form_status,#kt_form_type').selectpicker();

	};

	return {
		// public functions
		init: function() {
			demo();
		},
	};
}();

jQuery(document).ready(function() {
	KTDatatableLocalSortDemo.init();
});