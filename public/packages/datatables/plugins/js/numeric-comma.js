/**
 * Pretty number
 */
$.fn.dataTable.ext.type.order['pretty-number-pre'] = function(d)
{
    return Math.floor(d.replace(/(<([^>]+)>)/ig, "").replace(/\./g, '').replace(/\((\d+)\%\)/, ''));
};

$.fn.dataTable.ext.type.order['pretty-number-asc'] = function(a, b)
{
    return ((a < b) ? -1 : ((a > b) ? 1 : 0));
};

$.fn.dataTable.ext.type.order['pretty-number-desc'] = function(a, b)
{
    return ((a < b) ? 1 : ((a > b) ? -1 : 0));
};

/**
 * VND Curency
 */
$.fn.dataTable.ext.type.order['vnd-currency-pre'] = function(d)
{
    return Math.floor(d.replace(/(<([^>]+)>)/ig, "").replace(/\./g, '').replace('K', ''));
};

$.fn.dataTable.ext.type.order['vnd-currency-asc'] = function(a, b)
{
    return ((a < b) ? -1 : ((a > b) ? 1 : 0));
};

$.fn.dataTable.ext.type.order['vnd-currency-desc'] = function(a, b)
{
    return ((a < b) ? 1 : ((a > b) ? -1 : 0));
};

/**
 * Sorting datetime with day names
 */
var customDateDDMMMYYYYToOrd = function (date) {
    "use strict"; //let's avoid tom-foolery in this function
    // Convert to a number YYYYMMDD which we can use to order
    var dateParts = date.split(" ");

    var string = dateParts[1];

    if(date.match(/^(mon|tue|wed|thu|fri|sat|sun)/i))
    {
	    dateParts = dateParts[1].split("-");

	    return (dateParts[1] * 100) + dateParts[0];
    }

    if(date.match(/^(Trung)/i))
    {
    	return 1000000 - 1;
    }

	return 1000000;
};

// This will help DataTables magic detect the "dd-MMM-yyyy" format; Unshift so that it's the first data type (so it takes priority over existing)
jQuery.fn.dataTableExt.aTypes.unshift(
    function (sData) {
        "use strict"; //let's avoid tom-foolery in this function

        if (/^(mon|tue|wed|thu|fri|sat|sun) \d{2}-\d{2}/i.test(sData)) {
            return 'daynames';
        }

        return null;
    }
);

// define the sorts
jQuery.fn.dataTableExt.oSort['daynames-asc'] = function (a, b) {
    "use strict"; //let's avoid tom-foolery in this function
    var ordA = customDateDDMMMYYYYToOrd(a),
        ordB = customDateDDMMMYYYYToOrd(b);
    return (ordA < ordB) ? -1 : ((ordA > ordB) ? 1 : 0);
};

jQuery.fn.dataTableExt.oSort['daynames-desc'] = function (a, b) {
    "use strict"; //let's avoid tom-foolery in this function
    var ordA = customDateDDMMMYYYYToOrd(a),
        ordB = customDateDDMMMYYYYToOrd(b);
    return (ordA < ordB) ? 1 : ((ordA > ordB) ? -1 : 0);
};

/**
 * Normal datetime
 */

var customDateTime = function(dateFull){

	dateFull = dateFull.trim()

	var dateParts = dateFull.split(" ");

	var time = dateParts[0];
    var date = dateParts[1];

    var timeParts = time.split(":");
    var dateParts = date.split("/");

    var unix = Math.floor(timeParts[0]) * 60 + Math.floor(timeParts[1]) + Math.floor(dateParts[0]) * 24 * 60 + Math.floor(dateParts[1]) * 10000

    return unix;
};

// This will help DataTables magic detect the "dd-MMM-yyyy" format; Unshift so that it's the first data type (so it takes priority over existing)
jQuery.fn.dataTableExt.aTypes.unshift(
    function (sData) {
        "use strict"; //let's avoid tom-foolery in this function

        if (/^\d{2}:\d{2} \d{2}\/\d{2}/i.test(sData)) {
			return 'datetime';
        }

        return null;
    }
);

// define the sorts
jQuery.fn.dataTableExt.oSort['datetime-asc'] = function (a, b) {
    "use strict"; //let's avoid tom-foolery in this function
    var ordA = customDateTime(a),
        ordB = customDateTime(b);
    return (ordA < ordB) ? -1 : ((ordA > ordB) ? 1 : 0);
};

jQuery.fn.dataTableExt.oSort['datetime-desc'] = function (a, b) {
    "use strict"; //let's avoid tom-foolery in this function
    var ordA = customDateTime(a),
        ordB = customDateTime(b);
    return (ordA < ordB) ? 1 : ((ordA > ordB) ? -1 : 0);
};