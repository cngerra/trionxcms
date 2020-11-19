/*JS Document*/
$(document).ready(function(){
	$.validator.addMethod("nameRx", function (value, element){
		return this.optional(element) || /^[a-zA-Z.]+(?:[\s-][a-zA-Z.]+)*$/.test(value);
	});
	$.validator.addMethod("zipRx", function (value, element){
		return this.optional(element) || /^\d{5}$/.test(value);
	});
	$.validator.addMethod("selectBoxRx", function (value, element){
		return this.optional(element) || !/^-1+$/.test(value);
	});							
	$.validator.addMethod("phoneRx", function (value, element){
		value = value.replace(/[-\ \)\(]/g, '');
		return this.optional(element) || /^\d{10}$/.test(value);
	});
	$.validator.addMethod("emailRx", function (value, element){
		return this.optional(element) || /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value);
	});

	//checking the other chekcboxes inside the table
	$('.parent-checkbox').change(function(){
		if($(this).prop('checked')){
			$('.checkbox').prop('checked', true);
		}
	});		

	initDateDropDown();
});

/** Date Dropdown **/
function initDateDropDown() {
	var currentDate = new Date();
	var currentYear = currentDate.getFullYear();
	var currentMonth = currentDate.getMonth();
	var numberOfDays = daysInMonth(currentYear, currentMonth);
	populateYearDropdown(1930, currentYear-18);
	populateMonthDropdown();
	populateDayDropdown(numberOfDays);
}

function populateYearDropdown(startYear, endYear) {
	var yearOptions = [];
		yearOptions.push('<option value="-1" class="dob-d">Year</option>');
	for (var y = endYear; y >= startYear; y--) {
		yearOptions.push('<option value="' + y + '">' + y + '</option>');
	}
	$('#year').html(yearOptions.join("\n"));
}
function populateMonthDropdown() {
	var monthOptions = [];
	monthOptions.push('<option value="-1" class="dob-d">Month</option>');
	var months = ['Month','January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
	for (var m = 1; m < months.length; m++) {
		monthOptions.push('<option value="' + m + '">' + months[m] + '</option>');
	}
	$('#month').html(monthOptions.join("\n"));
}
function populateDayDropdown(numberOfDays) {
	var dayOptions = [];
	dayOptions.push('<option value="-1" class="dob-d">Day</option>');
	for (var d = 1; d <= numberOfDays; d++) {
		dayOptions.push('<option value="' + d + '">' + d + '</option>');
	}
	$('#day').html(dayOptions.join("\n"));
}
function selectYearDropdown(year) {
	$('#year option[value=' + year + ']').attr('selected', true);
}
function selectMonthDropdown(month) {
	$('#month option[value=' + month + ']').attr('selected', true);
}
function selectDayDropdown(day) {
	$('#day option[value=' + day + ']').attr('selected', true);
}
function refreshDayDropdown() {
	var year = parseInt($('#year').val());
	var month = parseInt($('#month').val());
	var day = parseInt($('#day').val());
	var numberOfDays = daysInMonth(year, month);
	populateDayDropdown(numberOfDays);
	if (day <= numberOfDays) {
		selectDayDropdown(day);
	} else {
		selectDayDropdown(numberOfDays);
	}
}

function daysInMonth(year, month) {
	//return new Date(year, month, 0).getDate();
	return new Date(year, month+1, 0).getDate();
}