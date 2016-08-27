/* _GMLfunc_is_real(val)
 * Wrapper for function: is_real.
 */
function _GMLfunc_is_real(val) {
	return typeof val == 'number';
}
//*/

/* _GMLfunc_is_string(val)
 * Wrapper for function: is_string.
 */
function _GMLfunc_is_string(val) {
	return typeof val == 'string';
}
//*/

/* _GMLfunc_random(xx)
 * Wrapper for function: random.
 */
function _GMLfunc_random(xx) {
	return xx * Math.random();
}
//*/

/* _GMLfunc_random_range(x1,x2)
 * Wrapper for function: random_range.
 */
function _GMLfunc_random_range(x1, x2) {
	var rand = Math.random();
	return x1 * (1 - rand) + x2 * rand;
}
//*/

/* _GMLfunc_irandom(xx)
 * Wrapper for function: irandom.
 */
function _GMLfunc_irandom(xx) {
	return Math.floor(xx * Math.random());
}
//*/

/* _GMLfunc_irandom_range(x1,x2)
 * Wrapper for function: irandom_range.
 */
function _GMLfunc_irandom_range(x1, x2) {
	return Math.floor(x1 * (1 - rand) + x2 * rand);
}
//*/

/* _GMLfunc_random_set_seed(seed)
 * Wrapper for function: random_set_seed. Requires seedrandom.js library by davidbau.
 */
function _GMLfunc_random_set_seed(seed) {
	window.seed = seed;
	return Math.seedrandom(seed);
}
//*/

/* _GMLfunc_random_get_seed()
 * Wrapper for function: random_get_seed. Requires seedrandom.js library by davidbau.
 */
function _GMLfunc_random_get_seed() {
	return window.seed;
}
//*/

/* _GMLfunc_randomize()
 * Wrapper for function: randomize. Requires seedrandom.js library by davidbau.
 */
function _GMLfunc_randomize() {
	return Math.seedrandom();
}
//*/

/* _GMLfunc_choose(x1,x2,x3,...)
 * Wrapper for function: choose.
 */
function _GMLfunc_choose() {
	if (arguments.length == 0) {
		return 0;
	}
	return arguments[irandom(arguments.length - 1)];
}
//*/

/* _GMLfunc_abs(xx)
 * Wrapper for function: abs.
 */
function _GMLfunc_abs(xx) {
	return Math.abs(xx);
}
//*/

/* _GMLfunc_round(xx)
 * Wrapper for function: round.
 */
function _GMLfunc_round(xx) {
	return Math.round(xx);
}
//*/

/* _GMLfunc_floor(xx)
 * Wrapper for function: floor.
 */
function _GMLfunc_floor(xx) {
	return Math.floor(xx);
}
//*/

/* _GMLfunc_ceil(xx)
 * Wrapper for function: ceil.
 */
function _GMLfunc_ceil(xx) {
	return Math.ceil(xx);
}
//*/

/* _GMLfunc_sign(xx)
 * Wrapper for function: sign.
 */
function _GMLfunc_sign(xx) {
	xx = +xx;
	if (xx === 0 || isNaN(xx)) {
		return xx;
	}
	return xx > 0 ? 1 : -1;
}
//*/

/* _GMLfunc_frac(xx)
 * Wrapper for function: frac.
 */
function _GMLfunc_frac(xx) {
	return xx.mod(1);
}
//*/

/* _GMLfunc_sqrt(xx)
 * Wrapper for function: sqrt.
 */
function _GMLfunc_sqrt(xx) {
	return Math.sqrt(xx);
}
//*/

/* _GMLfunc_sqr(xx)
 * Wrapper for function: sqr.
 */
function _GMLfunc_sqr(xx) {
	return xx * xx;
}
//*/

/* _GMLfunc_exp(xx)
 * Wrapper for function: exp.
 */
function _GMLfunc_exp(xx) {
	return Math.exp(xx);
}
//*/

/* _GMLfunc_ln(xx)
 * Wrapper for function: ln.
 */
function _GMLfunc_ln(xx) {
	return Math.log(xx);
}
//*/

/* _GMLfunc_log2(xx)
 * Wrapper for function: log2.
 */
function _GMLfunc_log2(xx) {
	return Math.log2(xx);
}
//*/

/* _GMLfunc_log10(xx)
 * Wrapper for function: log10.
 */
function _GMLfunc_log10(xx) {
	return Math.log10(xx);
}
//*/

/* _GMLfunc_sin(xx)
 * Wrapper for function: sin.
 */
function _GMLfunc_sin(xx) {
	return Math.sin(xx);
}
//*/

/* _GMLfunc_cos(xx)
 * Wrapper for function: cos.
 */
function _GMLfunc_cos(xx) {
	return Math.cos(xx);
}
//*/

/* _GMLfunc_tan(xx)
 * Wrapper for function: tan.
 */
function _GMLfunc_tan(xx) {
	return Math.tan(xx);
}
//*/

/* _GMLfunc_arcsin(xx)
 * Wrapper for function: arcsin.
 */
function _GMLfunc_arcsin(xx) {
	return Math.asin(xx);
}
//*/

/* _GMLfunc_arccos(xx)
 * Wrapper for function: arccos.
 */
function _GMLfunc_arccos(xx) {
	return Math.acos(xx);
}
//*/

/* _GMLfunc_arctan(xx)
 * Wrapper for function: arctan.
 */
function _GMLfunc_arctan(xx) {
	return Math.atan(xx);
}
//*/

/* _GMLfunc_arctan2(yy,xx)
 * Wrapper for function: arctan2.
 */
function _GMLfunc_arctan2(yy, xx) {
	return Math.atan2(yy, xx);
}
//*/

/* _GMLfunc_degtorad(xx)
 * Wrapper for function: degtorad.
 */
function _GMLfunc_degtorad(xx) {
	return xx * 180 / Math.PI;
}
//*/

/* _GMLfunc_radtodeg(xx)
 * Wrapper for function: radtodeg.
 */
function _GMLfunc_radtodeg(xx) {
	return xx * Math.PI / 180;
}
//*/

/* _GMLfunc_power(xx,n)
 * Wrapper for function: power.
 */
function _GMLfunc_power(xx, n) {
	return Math.pow(xx, n);
}
//*/

/* _GMLfunc_logn(n,xx)
 * Wrapper for function: logn.
 */
function _GMLfunc_logn(n, xx) {
	return Math.log(xx) / Math.log(n);
}
//*/

/* _GMLfunc_min(x1,x2,x3,...)
 * Wrapper for function: min.
 */
function _GMLfunc_min() {
	switch (arguments.length) {
	case 0:
		return 0;
		break;
	case 1:
		return arguments[0];
		break;
	case 2:
		return Math.min(arguments[0], arguments[1]);
		break;
	case 3:
		return Math.min(arguments[0], arguments[1], arguments[2]);
		break;
	case 4:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3]);
		break;
	case 5:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4]);
		break;
	case 6:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
		break;
	case 7:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6]);
		break;
	case 8:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7]);
		break;
	case 9:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8]);
		break;
	case 10:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9]);
		break;
	case 11:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10]);
		break;
	case 12:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11]);
		break;
	case 13:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12]);
		break;
	case 14:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13]);
		break;
	case 15:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14]);
		break;
	case 16:
		return Math.min(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14], arguments[15]);
		break;
	default:
		return 0;
		break;
	}
}
//*/

/* _GMLfunc_max(x1,x2,x3,...)
 * Wrapper for function: max.
 */
function _GMLfunc_max() {
	switch (arguments.length) {
	case 0:
		return 0;
		break;
	case 1:
		return arguments[0];
		break;
	case 2:
		return Math.max(arguments[0], arguments[1]);
		break;
	case 3:
		return Math.max(arguments[0], arguments[1], arguments[2]);
		break;
	case 4:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3]);
		break;
	case 5:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4]);
		break;
	case 6:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
		break;
	case 7:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6]);
		break;
	case 8:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7]);
		break;
	case 9:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8]);
		break;
	case 10:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9]);
		break;
	case 11:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10]);
		break;
	case 12:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11]);
		break;
	case 13:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12]);
		break;
	case 14:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13]);
		break;
	case 15:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14]);
		break;
	case 16:
		return Math.max(arguments[0], arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14], arguments[15]);
		break;
	default:
		return 0;
		break;
	}
}
//*/

/* _GMLfunc_mean(x1,x2,x3,...)
 * Wrapper for function: mean.
 */
function _GMLfunc_mean() {
	sum = arguments.reduce((previous, current) => current += previous);
	return sum / values.length;
}
//*/

/* _GMLfunc_median(x1,x2,x3,...)
 * Wrapper for function: median.
 */
function _GMLfunc_median() {
	values = arguments;
	values.sort((a, b) => a - b);
	lowMiddle = Math.floor((values.length - 1) / 2);
	highMiddle = Math.ceil((values.length - 1) / 2);
	return (values[lowMiddle] + values[highMiddle]) / 2;
}
//*/

/* _GMLfunc_point_distance(x1,y1,x2,y2)
 * Wrapper for function: point_distance.
 */
function _GMLfunc_point_distance(x1, y1, x2, y2) {
	return Math.sqrt(Math.pow(x2-x1, 2) + Math.pow(y2-y1, 2));
}
//*/

/* _GMLfunc_point_direction(x1,y1,x2,y2)
 * Wrapper for function: point_direction.
 */
function _GMLfunc_point_direction(x1, y1, x2, y2) {
	return Math.atan2(y1 - y2, x2 - x1) * 180 / Math.PI;
}
//*/

/* _GMLfunc_lengthdir_x(len,dir)
 * Wrapper for function: lengthdir_x.
 */
function _GMLfunc_lengthdir_x(len, dir) {
	return len * Math.cos(dir * Math.PI / 180);
}
//*/

/* _GMLfunc_lengthdir_y(len,dir)
 * Wrapper for function: lengthdir_y.
 */
function _GMLfunc_lengthdir_y(len, dir) {
	return len * -Math.sin(dir * Math.PI / 180);
}
//*/

/* _GMLfunc_real(str)
 * Wrapper for function: real.
 */
function _GMLfunc_real(str) {
	return parseFloat(str);
}
//*/

/* _GMLfunc_string(val)
 * Wrapper for function: string.
 */
function _GMLfunc_string(val) {
	return val.toString();
}
//*/

/* _GMLfunc_string_format(val,total,dec)
 * Wrapper for function: string_format.
 */
function _GMLfunc_string_format(val, total, dec) {
	return val.toFixed(dec);
}
//*/

/* _GMLfunc_chr(val)
 * Wrapper for function: chr.
 */
function _GMLfunc_chr(val) {
	return String.fromCharCode(val);
}
//*/

/* _GMLfunc_ord(char)
 * Wrapper for function: ord.
 */
function _GMLfunc_ord(chr) {
	return chr.charCodeAt(0);
}
//*/

/* _GMLfunc_string_length(str)
 * Wrapper for function: string_length.
 */
function _GMLfunc_string_length(str) {
	return str.length;
}
//*/

/* _GMLfunc_string_pos(substr,str)
 * Wrapper for function: string_pos.
 */
function _GMLfunc_string_pos(substr, str) {
	return str.search(substr) + 1;
}
//*/

/* _GMLfunc_string_copy(str,index,count)
 * Wrapper for function: string_copy.
 */
function _GMLfunc_string_copy(str, index, count) {
	return str.slice(index - 1, count);
}
//*/

/* _GMLfunc_string_char_at(str,index)
 * Wrapper for function: string_char_at.
 */
function _GMLfunc_string_char_at(str, index) {
	return str.charAt(index - 1);
}
//*/

/* _GMLfunc_string_delete(str,index,count)
 * Wrapper for function: string_delete.
 */
function _GMLfunc_string_delete(str, index, count) {
	return str.slice(0,index - 1) + str.slice(index - 1 + count);
}
//*/

/* _GMLfunc_string_insert(substr,str,index)
 * Wrapper for function: string_insert.
 */
function _GMLfunc_string_insert(substr, str, index) {
	return str.slice(0,index - 1) + substr + str.slice(index - 1);
}
//*/

/* _GMLfunc_string_lower(str)
 * Wrapper for function: string_lower.
 */
function _GMLfunc_string_lower(str) {
	return str.toLowerCase();
}
//*/

/* _GMLfunc_string_upper(str)
 * Wrapper for function: string_upper.
 */
function _GMLfunc_string_upper(str) {
	return str.toUpperCase();
}
//*/

/* _GMLfunc_string_repeat(str,count)
 * Wrapper for function: string_repeat.
 */
function _GMLfunc_string_repeat(str, count) {
	return str.repeat(count);
}
//*/

/* _GMLfunc_string_letters(str)
 * Wrapper for function: string_letters.
 */
function _GMLfunc_string_letters(str) {
	return str.replace(/[^a-zA-Z]/g, '');
}
//*/

/* _GMLfunc_string_digits(str)
 * Wrapper for function: string_digits.
 */
function _GMLfunc_string_digits(str) {
	return str.replace(/[^0-9]/g, '');
}
//*/

/* _GMLfunc_string_lettersdigits(str)
 * Wrapper for function: string_lettersdigits.
 */
function _GMLfunc_string_lettersdigits(str) {
	return string_lettersdigits(str);
	return str.replace(/[^0-9a-zA-Z]/g, '');
}
//*/

/* _GMLfunc_string_replace(str,substr,newstr)
 * Wrapper for function: string_replace.
 */
function _GMLfunc_string_replace(str, substr, newstr) {
	return str.replace(substr, newstr);
}
//*/

/* _GMLfunc_string_replace_all(str,substr,newstr)
 * Wrapper for function: string_replace_all.
 */
function _GMLfunc_string_replace_all(str, substr, newstr) {
	return str.replace(new RegExp(substr, 'g'), newstr);
}
//*/

/* _GMLfunc_string_count(substr,str)
 * Wrapper for function: string_count.
 */
function _GMLfunc_string_count(substr, str) {
	return str.count(substr);
}
//*/

/* _GMLfunc_clipboard_has_text()
 * Wrapper for function: clipboard_has_text.
 * /
function _GMLfunc_clipboard_has_text() {
	return clipboard_has_text();
}
//*/

/* _GMLfunc_clipboard_set_text(str)
 * Wrapper for function: clipboard_set_text.
 * /
function _GMLfunc_clipboard_set_text(str) {
	return clipboard_set_text(str);
}
//*/

/* _GMLfunc_clipboard_get_text()
 * Wrapper for function: clipboard_get_text.
 * /
function _GMLfunc_clipboard_get_text() {
	return clipboard_get_text();
}
//*/

/* _GMLfunc_date_current_datetime()
 * Wrapper for function: date_current_datetime.
 * /
function _GMLfunc_date_current_datetime() {
	return date_current_datetime();
}
//*/

/* _GMLfunc_date_current_date()
 * Wrapper for function: date_current_date.
 * /
function _GMLfunc_date_current_date() {
	return date_current_date();
}
//*/

/* _GMLfunc_date_current_time()
 * Wrapper for function: date_current_time.
 * /
function _GMLfunc_date_current_time() {
	return date_current_time();
}
//*/

/* _GMLfunc_date_create_datetime(year,month,day,hour,minute,second)
 * Wrapper for function: date_create_datetime.
 * /
function _GMLfunc_date_create_datetime(year, month, day, hour, minute, second) {
	return date_create_datetime(year, month, day, hour, minute, second);
}
//*/

/* _GMLfunc_date_create_date(year,month,day)
 * Wrapper for function: date_create_date.
 * /
function _GMLfunc_date_create_date(year, month, day) {
	return date_create_date(year, month, day);
}
//*/

/* _GMLfunc_date_create_time(hour,minute,second)
 * Wrapper for function: date_create_time.
 * /
function _GMLfunc_date_create_time(hour, minute, second) {
	return date_create_time(hour, minute, second);
}
//*/

/* _GMLfunc_date_valid_datetime(year,month,day,hour,minute,second)
 * Wrapper for function: date_valid_datetime.
 * /
function _GMLfunc_date_valid_datetime(year, month, day, hour, minute, second) {
	return date_valid_datetime(year, month, day, hour, minute, second);
}
//*/

/* _GMLfunc_date_valid_date(year,month,day)
 * Wrapper for function: date_valid_date.
 * /
function _GMLfunc_date_valid_date(year, month, day) {
	return date_valid_date(year, month, day);
}
//*/

/* _GMLfunc_date_valid_time(hour,minute,second)
 * Wrapper for function: date_valid_time.
 * /
function _GMLfunc_date_valid_time(hour, minute, second) {
	return date_valid_time(hour, minute, second);
}
//*/

/* _GMLfunc_date_inc_year(date,amount)
 * Wrapper for function: date_inc_year.
 * /
function _GMLfunc_date_inc_year(date, amount) {
	return date_inc_year(date, amount);
}
//*/

/* _GMLfunc_date_inc_month(date,amount)
 * Wrapper for function: date_inc_month.
 * /
function _GMLfunc_date_inc_month(date, amount) {
	return date_inc_month(date, amount);
}
//*/

/* _GMLfunc_date_inc_week(date,amount)
 * Wrapper for function: date_inc_week.
 * /
function _GMLfunc_date_inc_week(date, amount) {
	return date_inc_week(date, amount);
}
//*/

/* _GMLfunc_date_inc_day(date,amount)
 * Wrapper for function: date_inc_day.
 * /
function _GMLfunc_date_inc_day(date, amount) {
	return date_inc_day(date, amount);
}
//*/

/* _GMLfunc_date_inc_hour(date,amount)
 * Wrapper for function: date_inc_hour.
 * /
function _GMLfunc_date_inc_hour(date, amount) {
	return date_inc_hour(date, amount);
}
//*/

/* _GMLfunc_date_inc_minute(date,amount)
 * Wrapper for function: date_inc_minute.
 * /
function _GMLfunc_date_inc_minute(date, amount) {
	return date_inc_minute(date, amount);
}
//*/

/* _GMLfunc_date_inc_second(date,amount)
 * Wrapper for function: date_inc_second.
 * /
function _GMLfunc_date_inc_second(date, amount) {
	return date_inc_second(date, amount);
}
//*/

/* _GMLfunc_date_get_year(date)
 * Wrapper for function: date_get_year.
 * /
function _GMLfunc_date_get_year(date) {
	return date_get_year(date);
}
//*/

/* _GMLfunc_date_get_month(date)
 * Wrapper for function: date_get_month.
 * /
function _GMLfunc_date_get_month(date) {
	return date_get_month(date);
}
//*/

/* _GMLfunc_date_get_week(date)
 * Wrapper for function: date_get_week.
 * /
function _GMLfunc_date_get_week(date) {
	return date_get_week(date);
}
//*/

/* _GMLfunc_date_get_day(date)
 * Wrapper for function: date_get_day.
 * /
function _GMLfunc_date_get_day(date) {
	return date_get_day(date);
}
//*/

/* _GMLfunc_date_get_hour(date)
 * Wrapper for function: date_get_hour.
 * /
function _GMLfunc_date_get_hour(date) {
	return date_get_hour(date);
}
//*/

/* _GMLfunc_date_get_minute(date)
 * Wrapper for function: date_get_minute.
 * /
function _GMLfunc_date_get_minute(date) {
	return date_get_minute(date);
}
//*/

/* _GMLfunc_date_get_second(date)
 * Wrapper for function: date_get_second.
 * /
function _GMLfunc_date_get_second(date) {
	return date_get_second(date);
}
//*/

/* _GMLfunc_date_get_weekday(date)
 * Wrapper for function: date_get_weekday.
 * /
function _GMLfunc_date_get_weekday(date) {
	return date_get_weekday(date);
}
//*/

/* _GMLfunc_date_get_day_of_year(date)
 * Wrapper for function: date_get_day_of_year.
 * /
function _GMLfunc_date_get_day_of_year(date) {
	return date_get_day_of_year(date);
}
//*/

/* _GMLfunc_date_get_hour_of_year(date)
 * Wrapper for function: date_get_hour_of_year.
 * /
function _GMLfunc_date_get_hour_of_year(date) {
	return date_get_hour_of_year(date);
}
//*/

/* _GMLfunc_date_get_minute_of_year(date)
 * Wrapper for function: date_get_minute_of_year.
 * /
function _GMLfunc_date_get_minute_of_year(date) {
	return date_get_minute_of_year(date);
}
//*/

/* _GMLfunc_date_get_second_of_year(date)
 * Wrapper for function: date_get_second_of_year.
 * /
function _GMLfunc_date_get_second_of_year(date) {
	return date_get_second_of_year(date);
}
//*/

/* _GMLfunc_date_year_span(date1,date2)
 * Wrapper for function: date_year_span.
 * /
function _GMLfunc_date_year_span(date1, date2) {
	return date_year_span(date1, date2);
}
//*/

/* _GMLfunc_date_month_span(date1,date2)
 * Wrapper for function: date_month_span.
 * /
function _GMLfunc_date_month_span(date1, date2) {
	return date_month_span(date1, date2);
}
//*/

/* _GMLfunc_date_week_span(date1,date2)
 * Wrapper for function: date_week_span.
 * /
function _GMLfunc_date_week_span(date1, date2) {
	return date_week_span(date1, date2);
}
//*/

/* _GMLfunc_date_day_span(date1,date2)
 * Wrapper for function: date_day_span.
 * /
function _GMLfunc_date_day_span(date1, date2) {
	return date_day_span(date1, date2);
}
//*/

/* _GMLfunc_date_hour_span(date1,date2)
 * Wrapper for function: date_hour_span.
 * /
function _GMLfunc_date_hour_span(date1, date2) {
	return date_hour_span(date1, date2);
}
//*/

/* _GMLfunc_date_minute_span(date1,date2)
 * Wrapper for function: date_minute_span.
 * /
function _GMLfunc_date_minute_span(date1, date2) {
	return date_minute_span(date1, date2);
}
//*/

/* _GMLfunc_date_second_span(date1,date2)
 * Wrapper for function: date_second_span.
 * /
function _GMLfunc_date_second_span(date1, date2) {
	return date_second_span(date1, date2);
}
//*/

/* _GMLfunc_date_compare_datetime(date1,date2)
 * Wrapper for function: date_compare_datetime.
 * /
function _GMLfunc_date_compare_datetime(date1, date2) {
	return date_compare_datetime(date1, date2);
}
//*/

/* _GMLfunc_date_compare_date(date1,date2)
 * Wrapper for function: date_compare_date.
 * /
function _GMLfunc_date_compare_date(date1, date2) {
	return date_compare_date(date1, date2);
}
//*/

/* _GMLfunc_date_compare_time(date1,date2)
 * Wrapper for function: date_compare_time.
 * /
function _GMLfunc_date_compare_time(date1, date2) {
	return date_compare_time(date1, date2);
}
//*/

/* _GMLfunc_date_date_of(date)
 * Wrapper for function: date_date_of.
 * /
function _GMLfunc_date_date_of(date) {
	return date_date_of(date);
}
//*/

/* _GMLfunc_date_time_of(date)
 * Wrapper for function: date_time_of.
 * /
function _GMLfunc_date_time_of(date) {
	return date_time_of(date);
}
//*/

/* _GMLfunc_date_datetime_string(date)
 * Wrapper for function: date_datetime_string.
 * /
function _GMLfunc_date_datetime_string(date) {
	return date_datetime_string(date);
}
//*/

/* _GMLfunc_date_date_string(date)
 * Wrapper for function: date_date_string.
 * /
function _GMLfunc_date_date_string(date) {
	return date_date_string(date);
}
//*/

/* _GMLfunc_date_time_string(date)
 * Wrapper for function: date_time_string.
 * /
function _GMLfunc_date_time_string(date) {
	return date_time_string(date);
}
//*/

/* _GMLfunc_date_days_in_month(date)
 * Wrapper for function: date_days_in_month.
 * /
function _GMLfunc_date_days_in_month(date) {
	return date_days_in_month(date);
}
//*/

/* _GMLfunc_date_days_in_year(date)
 * Wrapper for function: date_days_in_year.
 * /
function _GMLfunc_date_days_in_year(date) {
	return date_days_in_year(date);
}
//*/

/* _GMLfunc_date_leap_year(date)
 * Wrapper for function: date_leap_year.
 * /
function _GMLfunc_date_leap_year(date) {
	return date_leap_year(date);
}
//*/

/* _GMLfunc_date_is_today(date)
 * Wrapper for function: date_is_today.
 * /
function _GMLfunc_date_is_today(date) {
	return date_is_today(date);
}
//*/

/* _GMLfunc_motion_set(dir,spd)
 * Wrapper for function: motion_set.
 */
function _GMLfunc_motion_set(dir, spd) {
	this.direction = dir;
	this.speed = spd;
}
//*/

/* _GMLfunc_motion_add(dir,spd)
 * Wrapper for function: motion_add.
 */
function _GMLfunc_motion_add(dir, spd) {
	var rdir = dir * Math.PI / 180;
	this.hspeed += spd * Math.cos(rdir);
	this.vspeed += spd * Math.cos(rdir);
}
//*/

/* _GMLfunc_place_free(xx,yy)
 * Wrapper for function: place_free.
 * /
function _GMLfunc_place_free(xx, yy) {
	return place_free(xx, yy);
}
//*/

/* _GMLfunc_place_empty(xx,yy)
 * Wrapper for function: place_empty.
 * /
function _GMLfunc_place_empty(xx, yy) {
	return place_empty(xx, yy);
}
//*/

/* _GMLfunc_place_meeting(xx,yy,obj)
 * Wrapper for function: place_meeting.
 */
function _GMLfunc_place_meeting(xx, yy, obj) {
def collCheck(instance,x,y,obj,color=(-1,-1,-1)):
	global gameDisplay,instances,_shape_sprite,_shape_w,_shape_h,_shape_xoffset,_shape_yoffset,_shape_count,_shape_col_start,_shape_col_num,_shape_data,_shape_data_colors;
	xx=x-_shape_xoffset[this.shape];
	yy=y-_shape_yoffset[this.shape];
	
	w=_shape_w[this.shape];
	h=_shape_h[this.shape];
	
	for inst in instances:
		while(inst) {
			if (inst.object_index!=obj) {
				continue;
			}
			
			if (inst==this) {
				continue;
			}
			if (inst.y+_shape_yoffset[inst.shape]>=yy+h) {
				continue;
			}
			
			_h=_shape_h[inst.shape]
			if (yy>=inst.y+_shape_yoffset[inst.shape]+_h) {
				continue;
			}
			
			_w=_shape_w[inst.shape];
			__x=int(inst.x-_shape_xoffset[this.shape]-xx+_shape_col_start[this.shape]);
			for _x in range(_shape_col_start[inst.shape],_shape_col_start[inst.shape]+_w):
				if __x<_shape_col_start[this.shape]:
					__x+=1;
					continue;
				if __x>=_shape_col_start[this.shape]+w:
					break;
				if _shape_col_num[__x]==0:
					__x+=1;
					continue;
				
				_i=1;
				for i in range(1,_shape_col_num[_x],2):
					if inst.y-_shape_yoffset[inst.shape]+_shape_data[_x][i-1]>yy+_shape_data[__x][_i]:
						_break = 0;
						for _i in range(_i,_shape_col_num[__x],2):
							if y-_shape_yoffset[inst.shape]+_shape_data[__x][i-1]<=yy+_shape_data[__x][_i]:
								_i += 1;
								_break = 1;
								break;
						if _i >= _shape_col_num[__x] or _break:
							_i += 1;
							break;
					if inst.y-_shape_yoffset[inst.shape]+_shape_data[_x][i]>=yy+_shape_data[__x][_i-1]:
						return true;
				
				__x+=1;
			
		}
	
	return false;
}
//*/

/* _GMLfunc_place_snapped(hsnap,vsnap)
 * Wrapper for function: place_snapped.
 * /
function _GMLfunc_place_snapped(hsnap, vsnap) {
	return place_snapped(hsnap, vsnap);
}
//*/

/* _GMLfunc_move_random(hsnap,vsnap)
 * Wrapper for function: move_random.
 * /
function _GMLfunc_move_random(hsnap, vsnap) {
	return move_random(hsnap, vsnap);
}
//*/

/* _GMLfunc_move_snap(hsnap,vsnap)
 * Wrapper for function: move_snap.
 * /
function _GMLfunc_move_snap(hsnap, vsnap) {
	return move_snap(hsnap, vsnap);
}
//*/

/* _GMLfunc_move_towards_point(xx,yy,sp)
 * Wrapper for function: move_towards_point.
 * /
function _GMLfunc_move_towards_point(xx, yy, sp) {
	return move_towards_point(xx, yy, sp);
}
//*/

/* _GMLfunc_move_contact_solid(dir,maxdist)
 * Wrapper for function: move_contact_solid.
 * /
function _GMLfunc_move_contact_solid(dir, maxdist) {
	return move_contact_solid(dir, maxdist);
}
//*/

/* _GMLfunc_move_contact_all(dir,maxdist)
 * Wrapper for function: move_contact_all.
 * /
function _GMLfunc_move_contact_all(dir, maxdist) {
	return move_contact_all(dir, maxdist);
}
//*/

/* _GMLfunc_move_outside_solid(dir,maxdist)
 * Wrapper for function: move_outside_solid.
 * /
function _GMLfunc_move_outside_solid(dir, maxdist) {
	return move_outside_solid(dir, maxdist);
}
//*/

/* _GMLfunc_move_outside_all(dir,maxdist)
 * Wrapper for function: move_outside_all.
 * /
function _GMLfunc_move_outside_all(dir, maxdist) {
	return move_outside_all(dir, maxdist);
}
//*/

/* _GMLfunc_move_bounce_solid(advanced)
 * Wrapper for function: move_bounce_solid.
 * /
function _GMLfunc_move_bounce_solid(advanced) {
	return move_bounce_solid(advanced);
}
//*/

/* _GMLfunc_move_bounce_all(advanced)
 * Wrapper for function: move_bounce_all.
 * /
function _GMLfunc_move_bounce_all(advanced) {
	return move_bounce_all(advanced);
}
//*/

/* _GMLfunc_move_wrap(hor,vert,margin)
 * Wrapper for function: move_wrap.
 * /
function _GMLfunc_move_wrap(hor, vert, margin) {
	return move_wrap(hor, vert, margin);
}
//*/

/* _GMLfunc_distance_to_point(xx,yy)
 * Wrapper for function: distance_to_point.
 * /
function _GMLfunc_distance_to_point(xx, yy) {
	return distance_to_point(xx, yy);
}
//*/

/* _GMLfunc_distance_to_object(obj)
 * Wrapper for function: distance_to_object.
 * /
function _GMLfunc_distance_to_object(obj) {
	return distance_to_object(obj);
}
//*/

/* _GMLfunc_position_empty(xx,yy)
 * Wrapper for function: position_empty.
 * /
function _GMLfunc_position_empty(xx, yy) {
	return position_empty(xx, yy);
}
//*/

/* _GMLfunc_position_meeting(xx,yy,obj)
 * Wrapper for function: position_meeting.
 * /
function _GMLfunc_position_meeting(xx, yy, obj) {
	return position_meeting(xx, yy, obj);
}
//*/

/* _GMLfunc_path_start(path,spd,endaction,absolute)
 * Wrapper for function: path_start.
 * /
function _GMLfunc_path_start(path, spd, endaction, absolute) {
	return path_start(path, spd, endaction, absolute);
}
//*/

/* _GMLfunc_path_end()
 * Wrapper for function: path_end.
 * /
function _GMLfunc_path_end() {
	return path_end();
}
//*/

/* _GMLfunc_mp_linear_step(xx,yy,spd,checkall)
 * Wrapper for function: mp_linear_step.
 * /
function _GMLfunc_mp_linear_step(xx, yy, spd, checkall) {
	return mp_linear_step(xx, yy, spd, checkall);
}
//*/

/* _GMLfunc_mp_potential_step(xx,yy,spd,checkall)
 * Wrapper for function: mp_potential_step.
 * /
function _GMLfunc_mp_potential_step(xx, yy, spd, checkall) {
	return mp_potential_step(xx, yy, spd, checkall);
}
//*/

/* _GMLfunc_mp_linear_step_object(xx,yy,spd,obj)
 * Wrapper for function: mp_linear_step_object.
 * /
function _GMLfunc_mp_linear_step_object(xx, yy, spd, obj) {
	return mp_linear_step_object(xx, yy, spd, obj);
}
//*/

/* _GMLfunc_mp_potential_step_object(xx,yy,spd,obj)
 * Wrapper for function: mp_potential_step_object.
 * /
function _GMLfunc_mp_potential_step_object(xx, yy, spd, obj) {
	return mp_potential_step_object(xx, yy, spd, obj);
}
//*/

/* _GMLfunc_mp_potential_settings(maxrot,rotstep,ahead,onspot)
 * Wrapper for function: mp_potential_settings.
 * /
function _GMLfunc_mp_potential_settings(maxrot, rotstep, ahead, onspot) {
	return mp_potential_settings(maxrot, rotstep, ahead, onspot);
}
//*/

/* _GMLfunc_mp_linear_path(path,xg,yg,stepsize,checkall)
 * Wrapper for function: mp_linear_path.
 * /
function _GMLfunc_mp_linear_path(path, xg, yg, stepsize, checkall) {
	return mp_linear_path(path, xg, yg, stepsize, checkall);
}
//*/

/* _GMLfunc_mp_potential_path(path,xg,yg,stepsize,factor,checkall)
 * Wrapper for function: mp_potential_path.
 * /
function _GMLfunc_mp_potential_path(path, xg, yg, stepsize, factor, checkall) {
	return mp_potential_path(path, xg, yg, stepsize, factor, checkall);
}
//*/

/* _GMLfunc_mp_linear_path_object(path,xg,yg,stepsize,obj)
 * Wrapper for function: mp_linear_path_object.
 * /
function _GMLfunc_mp_linear_path_object(path, xg, yg, stepsize, obj) {
	return mp_linear_path_object(path, xg, yg, stepsize, obj);
}
//*/

/* _GMLfunc_mp_potential_path_object(path,xg,yg,stepsize,factor,obj)
 * Wrapper for function: mp_potential_path_object.
 * /
function _GMLfunc_mp_potential_path_object(path, xg, yg, stepsize, factor, obj) {
	return mp_potential_path_object(path, xg, yg, stepsize, factor, obj);
}
//*/

/* _GMLfunc_mp_grid_create(left,top,hcells,vcells,cellwidth,cellheight)
 * Wrapper for function: mp_grid_create.
 * /
function _GMLfunc_mp_grid_create(left, top, hcells, vcells, cellwidth, cellheight) {
	return mp_grid_create(left, top, hcells, vcells, cellwidth, cellheight);
}
//*/

/* _GMLfunc_mp_grid_destroy(_id)
 * Wrapper for function: mp_grid_destroy.
 * /
function _GMLfunc_mp_grid_destroy(_id) {
	return mp_grid_destroy(_id);
}
//*/

/* _GMLfunc_mp_grid_clear_all(_id)
 * Wrapper for function: mp_grid_clear_all.
 * /
function _GMLfunc_mp_grid_clear_all(_id) {
	return mp_grid_clear_all(_id);
}
//*/

/* _GMLfunc_mp_grid_clear_cell(_id,h,v)
 * Wrapper for function: mp_grid_clear_cell.
 * /
function _GMLfunc_mp_grid_clear_cell(_id, h, v) {
	return mp_grid_clear_cell(_id, h, v);
}
//*/

/* _GMLfunc_mp_grid_clear_rectangle(_id,left,top,right,bottom)
 * Wrapper for function: mp_grid_clear_rectangle.
 * /
function _GMLfunc_mp_grid_clear_rectangle(_id, left, top, right, bottom) {
	return mp_grid_clear_rectangle(_id, left, top, right, bottom);
}
//*/

/* _GMLfunc_mp_grid_add_cell(_id,h,v)
 * Wrapper for function: mp_grid_add_cell.
 * /
function _GMLfunc_mp_grid_add_cell(_id, h, v) {
	return mp_grid_add_cell(_id, h, v);
}
//*/

/* _GMLfunc_mp_grid_add_rectangle(_id,left,top,right,bottom)
 * Wrapper for function: mp_grid_add_rectangle.
 * /
function _GMLfunc_mp_grid_add_rectangle(_id, left, top, right, bottom) {
	return mp_grid_add_rectangle(_id, left, top, right, bottom);
}
//*/

/* _GMLfunc_mp_grid_add_instances(_id,obj,prec)
 * Wrapper for function: mp_grid_add_instances.
 * /
function _GMLfunc_mp_grid_add_instances(_id, obj, prec) {
	return mp_grid_add_instances(_id, obj, prec);
}
//*/

/* _GMLfunc_mp_grid_path(_id,path,_xstart,_ystart,xgoal,ygoal,allowdiag)
 * Wrapper for function: mp_grid_path.
 * /
function _GMLfunc_mp_grid_path(_id, path, _xstart, _ystart, xgoal, ygoal, allowdiag) {
	return mp_grid_path(_id, path, _xstart, _ystart, xgoal, ygoal, allowdiag);
}
//*/

/* _GMLfunc_mp_grid_draw(_id)
 * Wrapper for function: mp_grid_draw.
 * /
function _GMLfunc_mp_grid_draw(_id) {
	return mp_grid_draw(_id);
}
//*/

/* _GMLfunc_collision_point(xx,yy,obj,prec,notme)
 * Wrapper for function: collision_point.
 * /
function _GMLfunc_collision_point(xx, yy, obj, prec, notme) {
	return collision_point(xx, yy, obj, prec, notme);
}
//*/

/* _GMLfunc_collision_rectangle(x1,y1,x2,y2,obj,prec,notme)
 * Wrapper for function: collision_rectangle.
 * /
function _GMLfunc_collision_rectangle(x1, y1, x2, y2, obj, prec, notme) {
	return collision_rectangle(x1, y1, x2, y2, obj, prec, notme);
}
//*/

/* _GMLfunc_collision_circle(x1,y1,radius,obj,prec,notme)
 * Wrapper for function: collision_circle.
 * /
function _GMLfunc_collision_circle(x1, y1, radius, obj, prec, notme) {
	return collision_circle(x1, y1, radius, obj, prec, notme);
}
//*/

/* _GMLfunc_collision_ellipse(x1,y1,x2,y2,obj,prec,notme)
 * Wrapper for function: collision_ellipse.
 * /
function _GMLfunc_collision_ellipse(x1, y1, x2, y2, obj, prec, notme) {
	return collision_ellipse(x1, y1, x2, y2, obj, prec, notme);
}
//*/

/* _GMLfunc_collision_line(x1,y1,x2,y2,obj,prec,notme)
 * Wrapper for function: collision_line.
 * /
function _GMLfunc_collision_line(x1, y1, x2, y2, obj, prec, notme) {
	return collision_line(x1, y1, x2, y2, obj, prec, notme);
}
//*/

/* _GMLfunc_instance_find(obj,n)
 * Wrapper for function: instance_find.
 * /
function _GMLfunc_instance_find(obj, n) {
	return instance_find(obj, n);
}
//*/

/* _GMLfunc_instance_exists(obj)
 * Wrapper for function: instance_exists.
 * /
function _GMLfunc_instance_exists(obj) {
	return instance_exists(obj);
}
//*/

/* _GMLfunc_instance_number(obj)
 * Wrapper for function: instance_number.
 * /
function _GMLfunc_instance_number(obj) {
	return instance_number(obj);
}
//*/

/* _GMLfunc_instance_position(xx,yy,obj)
 * Wrapper for function: instance_position.
 * /
function _GMLfunc_instance_position(xx, yy, obj) {
	return instance_position(xx, yy, obj);
}
//*/

/* _GMLfunc_instance_nearest(xx,yy,obj)
 * Wrapper for function: instance_nearest.
 * /
function _GMLfunc_instance_nearest(xx, yy, obj) {
	return instance_nearest(xx, yy, obj);
}
//*/

/* _GMLfunc_instance_furthest(xx,yy,obj)
 * Wrapper for function: instance_furthest.
 * /
function _GMLfunc_instance_furthest(xx, yy, obj) {
	return instance_furthest(xx, yy, obj);
}
//*/

/* _GMLfunc_instance_place(xx,yy,obj)
 * Wrapper for function: instance_place.
 * /
function _GMLfunc_instance_place(xx, yy, obj) {
	return instance_place(xx, yy, obj);
}
//*/

/* _GMLfunc_instance_create(xx,yy,obj)
 * Wrapper for function: instance_create.
 * /
function _GMLfunc_instance_create(xx, yy, obj) {
	return instance_create(xx, yy, obj);
}
//*/

/* _GMLfunc_instance_copy(performevent)
 * Wrapper for function: instance_copy.
 * /
function _GMLfunc_instance_copy(performevent) {
	return instance_copy(performevent);
}
//*/

/* _GMLfunc_instance_change(obj,performevents)
 * Wrapper for function: instance_change.
 * /
function _GMLfunc_instance_change(obj, performevents) {
	return instance_change(obj, performevents);
}
//*/

/* _GMLfunc_instance_destroy()
 * Wrapper for function: instance_destroy.
 * /
function _GMLfunc_instance_destroy() {
	return instance_destroy();
}
//*/

/* _GMLfunc_position_destroy(xx,yy)
 * Wrapper for function: position_destroy.
 * /
function _GMLfunc_position_destroy(xx, yy) {
	return position_destroy(xx, yy);
}
//*/

/* _GMLfunc_position_change(xx,yy,obj,performevents)
 * Wrapper for function: position_change.
 * /
function _GMLfunc_position_change(xx, yy, obj, performevents) {
	return position_change(xx, yy, obj, performevents);
}
//*/

/* _GMLfunc_instance_deactivate_all(notme)
 * Wrapper for function: instance_deactivate_all.
 * /
function _GMLfunc_instance_deactivate_all(notme) {
	return instance_deactivate_all(notme);
}
//*/

/* _GMLfunc_instance_deactivate_object(obj)
 * Wrapper for function: instance_deactivate_object.
 * /
function _GMLfunc_instance_deactivate_object(obj) {
	return instance_deactivate_object(obj);
}
//*/

/* _GMLfunc_instance_deactivate_region(left,top,width,height,inside,notme)
 * Wrapper for function: instance_deactivate_region.
 * /
function _GMLfunc_instance_deactivate_region(left, top, width, height, inside, notme) {
	return instance_deactivate_region(left, top, width, height, inside, notme);
}
//*/

/* _GMLfunc_instance_activate_all()
 * Wrapper for function: instance_activate_all.
 * /
function _GMLfunc_instance_activate_all() {
	return instance_activate_all();
}
//*/

/* _GMLfunc_instance_activate_object(obj)
 * Wrapper for function: instance_activate_object.
 * /
function _GMLfunc_instance_activate_object(obj) {
	return instance_activate_object(obj);
}
//*/

/* _GMLfunc_instance_activate_region(left,top,width,height,inside)
 * Wrapper for function: instance_activate_region.
 * /
function _GMLfunc_instance_activate_region(left, top, width, height, inside) {
	return instance_activate_region(left, top, width, height, inside);
}
//*/

/* _GMLfunc_sleep(millisec)
 * Wrapper for function: sleep.
 * /
function _GMLfunc_sleep(millisec) {
	return sleep(millisec);
}
//*/

/* _GMLfunc_room_goto(numb)
 * Wrapper for function: room_goto.
 * /
function _GMLfunc_room_goto(numb) {
	return room_goto(numb);
}
//*/

/* _GMLfunc_room_goto_previous()
 * Wrapper for function: room_goto_previous.
 * /
function _GMLfunc_room_goto_previous() {
	return room_goto_previous();
}
//*/

/* _GMLfunc_room_goto_next()
 * Wrapper for function: room_goto_next.
 * /
function _GMLfunc_room_goto_next() {
	return room_goto_next();
}
//*/

/* _GMLfunc_room_previous(numb)
 * Wrapper for function: room_previous.
 * /
function _GMLfunc_room_previous(numb) {
	return room_previous(numb);
}
//*/

/* _GMLfunc_room_next(numb)
 * Wrapper for function: room_next.
 * /
function _GMLfunc_room_next(numb) {
	return room_next(numb);
}
//*/

/* _GMLfunc_room_restart()
 * Wrapper for function: room_restart.
 * /
function _GMLfunc_room_restart() {
	return room_restart();
}
//*/

/* _GMLfunc_game_end()
 * Wrapper for function: game_end.
 * /
function _GMLfunc_game_end() {
	return game_end();
}
//*/

/* _GMLfunc_game_restart()
 * Wrapper for function: game_restart.
 * /
function _GMLfunc_game_restart() {
	return game_restart();
}
//*/

/* _GMLfunc_game_load(filename)
 * Wrapper for function: game_load.
 * /
function _GMLfunc_game_load(filename) {
	return game_load(filename);
}
//*/

/* _GMLfunc_game_save(filename)
 * Wrapper for function: game_save.
 * /
function _GMLfunc_game_save(filename) {
	return game_save(filename);
}
//*/

/* _GMLfunc_transition_define(kind,name)
 * Wrapper for function: transition_define.
 * /
function _GMLfunc_transition_define(kind, name) {
	return transition_define(kind, name);
}
//*/

/* _GMLfunc_transition_exists(kind)
 * Wrapper for function: transition_exists.
 * /
function _GMLfunc_transition_exists(kind) {
	return transition_exists(kind);
}
//*/

/* _GMLfunc_event_perform(type,numb)
 * Wrapper for function: event_perform.
 * /
function _GMLfunc_event_perform(type, numb) {
	return event_perform(type, numb);
}
//*/

/* _GMLfunc_event_user(numb)
 * Wrapper for function: event_user.
 * /
function _GMLfunc_event_user(numb) {
	return event_user(numb);
}
//*/

/* _GMLfunc_event_perform_object(obj,type,numb)
 * Wrapper for function: event_perform_object.
 * /
function _GMLfunc_event_perform_object(obj, type, numb) {
	return event_perform_object(obj, type, numb);
}
//*/

/* _GMLfunc_event_inherited()
 * Wrapper for function: event_inherited.
 * /
function _GMLfunc_event_inherited() {
	return event_inherited();
}
//*/

/* _GMLfunc_show_debug_message(str)
 * Wrapper for function: show_debug_message.
 * /
function _GMLfunc_show_debug_message(str) {
	return show_debug_message(str);

	 # define _GMLfunc_ /* _GMLfunc_ * Wrapper for return
	#define _GMLfunc_/* _GMLfunc_ * Wrapper for function:  */
	return
	function  :  *  /
	 # define _GMLfunc_ /* _GMLfunc_ * Wrapper for return
	#define _GMLfunc_/* _GMLfunc_ * Wrapper for function:  */
	return
	function  :  *  /
	 # define _GMLfunc_ /* _GMLfunc_ * Wrapper for return
	#define _GMLfunc_/* _GMLfunc_ * Wrapper for function:  */
	return
	function  :  *  /
	 # define _GMLfunc_ /* _GMLfunc_ * Wrapper for return
	#define _GMLfunc_/* _GMLfunc_ * Wrapper for function:  */
	return
	function  :  *  /
	 # define _GMLfunc_ /* _GMLfunc_ * Wrapper for return
	#define _GMLfunc_/* _GMLfunc_ * Wrapper for function:  */
	return
	function  :  *  /
	 # define _GMLfunc_ /* _GMLfunc_ * Wrapper for return
	#define _GMLfunc_/* _GMLfunc_ * Wrapper for function:  */
	return
	function  :  *  /
	 # define _GMLfunc_ /* _GMLfunc_ * Wrapper for return
	#define _GMLfunc_/* _GMLfunc_ * Wrapper for function:  */
	return
	function  :  *  /
}
//*/

/* _GMLfunc_set_program_priority(priority)
 * Wrapper for function: set_program_priority.
 * /
function _GMLfunc_set_program_priority(priority) {
	return set_program_priority(priority);
}
//*/

/* _GMLfunc_set_application_title(title)
 * Wrapper for function: set_application_title.
 * /
function _GMLfunc_set_application_title(title) {
	return set_application_title(title);
}
//*/

/* _GMLfunc_keyboard_set_map(key1,key2)
 * Wrapper for function: keyboard_set_map.
 * /
function _GMLfunc_keyboard_set_map(key1, key2) {
	return keyboard_set_map(key1, key2);
}
//*/

/* _GMLfunc_keyboard_get_map(key)
 * Wrapper for function: keyboard_get_map.
 * /
function _GMLfunc_keyboard_get_map(key) {
	return keyboard_get_map(key);
}
//*/

/* _GMLfunc_keyboard_unset_map()
 * Wrapper for function: keyboard_unset_map.
 * /
function _GMLfunc_keyboard_unset_map() {
	return keyboard_unset_map();
}
//*/

/* _GMLfunc_keyboard_check(key)
 * Wrapper for function: keyboard_check.
 * /
function _GMLfunc_keyboard_check(key) {
	return keyboard_check(key);
}
//*/

/* _GMLfunc_keyboard_check_pressed(key)
 * Wrapper for function: keyboard_check_pressed.
 * /
function _GMLfunc_keyboard_check_pressed(key) {
	return keyboard_check_pressed(key);
}
//*/

/* _GMLfunc_keyboard_check_released(key)
 * Wrapper for function: keyboard_check_released.
 * /
function _GMLfunc_keyboard_check_released(key) {
	return keyboard_check_released(key);
}
//*/

/* _GMLfunc_keyboard_check_direct(key)
 * Wrapper for function: keyboard_check_direct.
 * /
function _GMLfunc_keyboard_check_direct(key) {
	return keyboard_check_direct(key);
}
//*/

/* _GMLfunc_keyboard_get_numlock()
 * Wrapper for function: keyboard_get_numlock.
 * /
function _GMLfunc_keyboard_get_numlock() {
	return keyboard_get_numlock();
}
//*/

/* _GMLfunc_keyboard_set_numlock(on)
 * Wrapper for function: keyboard_set_numlock.
 * /
function _GMLfunc_keyboard_set_numlock(on) {
	return keyboard_set_numlock(on);
}
//*/

/* _GMLfunc_keyboard_key_press(key)
 * Wrapper for function: keyboard_key_press.
 * /
function _GMLfunc_keyboard_key_press(key) {
	return keyboard_key_press(key);
}
//*/

/* _GMLfunc_keyboard_key_release(key)
 * Wrapper for function: keyboard_key_release.
 * /
function _GMLfunc_keyboard_key_release(key) {
	return keyboard_key_release(key);
}
//*/

/* _GMLfunc_keyboard_clear(key)
 * Wrapper for function: keyboard_clear.
 * /
function _GMLfunc_keyboard_clear(key) {
	return keyboard_clear(key);
}
//*/

/* _GMLfunc_io_clear()
 * Wrapper for function: io_clear.
 * /
function _GMLfunc_io_clear() {
	return io_clear();
}
//*/

/* _GMLfunc_io_handle()
 * Wrapper for function: io_handle.
 * /
function _GMLfunc_io_handle() {
	return io_handle();
}
//*/

/* _GMLfunc_keyboard_wait()
 * Wrapper for function: keyboard_wait.
 * /
function _GMLfunc_keyboard_wait() {
	return keyboard_wait();
}
//*/

/* _GMLfunc_mouse_check_button(button)
 * Wrapper for function: mouse_check_button.
 * /
function _GMLfunc_mouse_check_button(button) {
	return mouse_check_button(button);
}
//*/

/* _GMLfunc_mouse_check_button_pressed(button)
 * Wrapper for function: mouse_check_button_pressed.
 * /
function _GMLfunc_mouse_check_button_pressed(button) {
	return mouse_check_button_pressed(button);
}
//*/

/* _GMLfunc_mouse_check_button_released(button)
 * Wrapper for function: mouse_check_button_released.
 * /
function _GMLfunc_mouse_check_button_released(button) {
	return mouse_check_button_released(button);
}
//*/

/* _GMLfunc_mouse_wheel_up()
 * Wrapper for function: mouse_wheel_up.
 * /
function _GMLfunc_mouse_wheel_up() {
	return mouse_wheel_up();
}
//*/

/* _GMLfunc_mouse_wheel_down()
 * Wrapper for function: mouse_wheel_down.
 * /
function _GMLfunc_mouse_wheel_down() {
	return mouse_wheel_down();
}
//*/

/* _GMLfunc_mouse_clear(button)
 * Wrapper for function: mouse_clear.
 * /
function _GMLfunc_mouse_clear(button) {
	return mouse_clear(button);
}
//*/

/* _GMLfunc_mouse_wait()
 * Wrapper for function: mouse_wait.
 * /
function _GMLfunc_mouse_wait() {
	return mouse_wait();
}
//*/

/* _GMLfunc_joystick_exists(_id)
 * Wrapper for function: joystick_exists.
 * /
function _GMLfunc_joystick_exists(_id) {
	return joystick_exists(_id);
}
//*/

/* _GMLfunc_joystick_direction(_id)
 * Wrapper for function: joystick_direction.
 * /
function _GMLfunc_joystick_direction(_id) {
	return joystick_direction(_id);
}
//*/

/* _GMLfunc_joystick_name(_id)
 * Wrapper for function: joystick_name.
 * /
function _GMLfunc_joystick_name(_id) {
	return joystick_name(_id);
}
//*/

/* _GMLfunc_joystick_axes(_id)
 * Wrapper for function: joystick_axes.
 * /
function _GMLfunc_joystick_axes(_id) {
	return joystick_axes(_id);
}
//*/

/* _GMLfunc_joystick_buttons(_id)
 * Wrapper for function: joystick_buttons.
 * /
function _GMLfunc_joystick_buttons(_id) {
	return joystick_buttons(_id);
}
//*/

/* _GMLfunc_joystick_has_pov(_id)
 * Wrapper for function: joystick_has_pov.
 * /
function _GMLfunc_joystick_has_pov(_id) {
	return joystick_has_pov(_id);
}
//*/

/* _GMLfunc_joystick_check_button(_id,button)
 * Wrapper for function: joystick_check_button.
 * /
function _GMLfunc_joystick_check_button(_id, button) {
	return joystick_check_button(_id, button);
}
//*/

/* _GMLfunc_joystick_xpos(_id)
 * Wrapper for function: joystick_xpos.
 * /
function _GMLfunc_joystick_xpos(_id) {
	return joystick_xpos(_id);
}
//*/

/* _GMLfunc_joystick_ypos(_id)
 * Wrapper for function: joystick_ypos.
 * /
function _GMLfunc_joystick_ypos(_id) {
	return joystick_ypos(_id);
}
//*/

/* _GMLfunc_joystick_zpos(_id)
 * Wrapper for function: joystick_zpos.
 * /
function _GMLfunc_joystick_zpos(_id) {
	return joystick_zpos(_id);
}
//*/

/* _GMLfunc_joystick_rpos(_id)
 * Wrapper for function: joystick_rpos.
 * /
function _GMLfunc_joystick_rpos(_id) {
	return joystick_rpos(_id);
}
//*/

/* _GMLfunc_joystick_upos(_id)
 * Wrapper for function: joystick_upos.
 * /
function _GMLfunc_joystick_upos(_id) {
	return joystick_upos(_id);
}
//*/

/* _GMLfunc_joystick_vpos(_id)
 * Wrapper for function: joystick_vpos.
 * /
function _GMLfunc_joystick_vpos(_id) {
	return joystick_vpos(_id);
}
//*/

/* _GMLfunc_joystick_pov(_id)
 * Wrapper for function: joystick_pov.
 * /
function _GMLfunc_joystick_pov(_id) {
	return joystick_pov(_id);
}
//*/

/* _GMLfunc_draw_sprite(sprite,subimg,xx,yy)
 * Wrapper for function: draw_sprite.
 * /
function _GMLfunc_draw_sprite(sprite, subimg, xx, yy) {
	return draw_sprite(sprite, subimg, xx, yy);
}
//*/

/* _GMLfunc_draw_sprite_ext(sprite,subimg,xx,yy,xscale,yscale,rot,color,alpha)
 * Wrapper for function: draw_sprite_ext.
 * /
function _GMLfunc_draw_sprite_ext(sprite, subimg, xx, yy, xscale, yscale, rot, color, alpha) {
	return draw_sprite_ext(sprite, subimg, xx, yy, xscale, yscale, rot, color, alpha);
}
//*/

/* _GMLfunc_draw_sprite_stretched(sprite,subimg,xx,yy,w,h)
 * Wrapper for function: draw_sprite_stretched.
 * /
function _GMLfunc_draw_sprite_stretched(sprite, subimg, xx, yy, w, h) {
	return draw_sprite_stretched(sprite, subimg, xx, yy, w, h);
}
//*/

/* _GMLfunc_draw_sprite_stretched_ext(sprite,subimg,xx,yy,w,h,color,alpha)
 * Wrapper for function: draw_sprite_stretched_ext.
 * /
function _GMLfunc_draw_sprite_stretched_ext(sprite, subimg, xx, yy, w, h, color, alpha) {
	return draw_sprite_stretched_ext(sprite, subimg, xx, yy, w, h, color, alpha);
}
//*/

/* _GMLfunc_draw_sprite_tiled(sprite,subimg,xx,yy)
 * Wrapper for function: draw_sprite_tiled.
 * /
function _GMLfunc_draw_sprite_tiled(sprite, subimg, xx, yy) {
	return draw_sprite_tiled(sprite, subimg, xx, yy);
}
//*/

/* _GMLfunc_draw_sprite_tiled_ext(sprite,subimg,xx,yy,xscale,yscale,color,alpha)
 * Wrapper for function: draw_sprite_tiled_ext.
 * /
function _GMLfunc_draw_sprite_tiled_ext(sprite, subimg, xx, yy, xscale, yscale, color, alpha) {
	return draw_sprite_tiled_ext(sprite, subimg, xx, yy, xscale, yscale, color, alpha);
}
//*/

/* _GMLfunc_draw_sprite_part(sprite,subimg,left,top,width,height,xx,yy)
 * Wrapper for function: draw_sprite_part.
 * /
function _GMLfunc_draw_sprite_part(sprite, subimg, left, top, width, height, xx, yy) {
	return draw_sprite_part(sprite, subimg, left, top, width, height, xx, yy);
}
//*/

/* _GMLfunc_draw_sprite_part_ext(sprite,subimg,left,top,width,height,xx,yy,xscale,yscale,color,alpha)
 * Wrapper for function: draw_sprite_part_ext.
 * /
function _GMLfunc_draw_sprite_part_ext(sprite, subimg, left, top, width, height, xx, yy, xscale, yscale, color, alpha) {
	return draw_sprite_part_ext(sprite, subimg, left, top, width, height, xx, yy, xscale, yscale, color, alpha);
}
//*/

/* _GMLfunc_draw_sprite_general(sprite,subimg,left,top,width,height,xx,yy,xscale,yscale,rot,c1,c2,c3,c4,alpha)
 * Wrapper for function: draw_sprite_general.
 * /
function _GMLfunc_draw_sprite_general(sprite, subimg, left, top, width, height, xx, yy, xscale, yscale, rot, c1, c2, c3, c4, alpha) {
	return draw_sprite_general(sprite, subimg, left, top, width, height, xx, yy, xscale, yscale, rot, c1, c2, c3, c4, alpha);
}
//*/

/* _GMLfunc_draw_background(back,xx,yy)
 * Wrapper for function: draw_background.
 * /
function _GMLfunc_draw_background(back, xx, yy) {
	return draw_background(back, xx, yy);
}
//*/

/* _GMLfunc_draw_background_ext(back,xx,yy,xscale,yscale,rot,color,alpha)
 * Wrapper for function: draw_background_ext.
 * /
function _GMLfunc_draw_background_ext(back, xx, yy, xscale, yscale, rot, color, alpha) {
	return draw_background_ext(back, xx, yy, xscale, yscale, rot, color, alpha);
}
//*/

/* _GMLfunc_draw_background_stretched(back,xx,yy,w,h)
 * Wrapper for function: draw_background_stretched.
 * /
function _GMLfunc_draw_background_stretched(back, xx, yy, w, h) {
	return draw_background_stretched(back, xx, yy, w, h);
}
//*/

/* _GMLfunc_draw_background_stretched_ext(back,xx,yy,w,h,color,alpha)
 * Wrapper for function: draw_background_stretched_ext.
 * /
function _GMLfunc_draw_background_stretched_ext(back, xx, yy, w, h, color, alpha) {
	return draw_background_stretched_ext(back, xx, yy, w, h, color, alpha);
}
//*/

/* _GMLfunc_draw_background_tiled(back,xx,yy)
 * Wrapper for function: draw_background_tiled.
 * /
function _GMLfunc_draw_background_tiled(back, xx, yy) {
	return draw_background_tiled(back, xx, yy);
}
//*/

/* _GMLfunc_draw_background_tiled_ext(back,xx,yy,xscale,yscale,color,alpha)
 * Wrapper for function: draw_background_tiled_ext.
 * /
function _GMLfunc_draw_background_tiled_ext(back, xx, yy, xscale, yscale, color, alpha) {
	return draw_background_tiled_ext(back, xx, yy, xscale, yscale, color, alpha);
}
//*/

/* _GMLfunc_draw_background_part(back,left,top,width,height,xx,yy)
 * Wrapper for function: draw_background_part.
 * /
function _GMLfunc_draw_background_part(back, left, top, width, height, xx, yy) {
	return draw_background_part(back, left, top, width, height, xx, yy);
}
//*/

/* _GMLfunc_draw_background_part_ext(back,left,top,width,height,xx,yy,xscale,yscale,color,alpha)
 * Wrapper for function: draw_background_part_ext.
 * /
function _GMLfunc_draw_background_part_ext(back, left, top, width, height, xx, yy, xscale, yscale, color, alpha) {
	return draw_background_part_ext(back, left, top, width, height, xx, yy, xscale, yscale, color, alpha);
}
//*/

/* _GMLfunc_draw_background_general(back,left,top,width,height,xx,yy,xscale,yscale,rot,c1,c2,c3,c4,alpha)
 * Wrapper for function: draw_background_general.
 * /
function _GMLfunc_draw_background_general(back, left, top, width, height, xx, yy, xscale, yscale, rot, c1, c2, c3, c4, alpha) {
	return draw_background_general(back, left, top, width, height, xx, yy, xscale, yscale, rot, c1, c2, c3, c4, alpha);
}
//*/

/* _GMLfunc_draw_clear(col)
 * Wrapper for function: draw_clear.
 * /
function _GMLfunc_draw_clear(col) {
	return draw_clear(col);
}
//*/

/* _GMLfunc_draw_clear_alpha(col,alpha)
 * Wrapper for function: draw_clear_alpha.
 * /
function _GMLfunc_draw_clear_alpha(col, alpha) {
	return draw_clear_alpha(col, alpha);
}
//*/

/* _GMLfunc_draw_point(xx,yy)
 * Wrapper for function: draw_point.
 * /
function _GMLfunc_draw_point(xx, yy) {
	return draw_point(xx, yy);
}
//*/

/* _GMLfunc_draw_line(x1,y1,x2,y2)
 * Wrapper for function: draw_line.
 * /
function _GMLfunc_draw_line(x1, y1, x2, y2) {
	return draw_line(x1, y1, x2, y2);
}
//*/

/* _GMLfunc_draw_line_width(x1,y1,x2,y2,w)
 * Wrapper for function: draw_line_width.
 * /
function _GMLfunc_draw_line_width(x1, y1, x2, y2, w) {
	return draw_line_width(x1, y1, x2, y2, w);
}
//*/

/* _GMLfunc_draw_rectangle(x1,y1,x2,y2,outline)
 * Wrapper for function: draw_rectangle.
 * /
function _GMLfunc_draw_rectangle(x1, y1, x2, y2, outline) {
	return draw_rectangle(x1, y1, x2, y2, outline);
}
//*/

/* _GMLfunc_draw_roundrect(x1,y1,x2,y2,outline)
 * Wrapper for function: draw_roundrect.
 * /
function _GMLfunc_draw_roundrect(x1, y1, x2, y2, outline) {
	return draw_roundrect(x1, y1, x2, y2, outline);
}
//*/

/* _GMLfunc_draw_triangle(x1,y1,x2,y2,x3,y3,outline)
 * Wrapper for function: draw_triangle.
 * /
function _GMLfunc_draw_triangle(x1, y1, x2, y2, x3, y3, outline) {
	return draw_triangle(x1, y1, x2, y2, x3, y3, outline);
}
//*/

/* _GMLfunc_draw_circle(xx,yy,r,outline)
 * Wrapper for function: draw_circle.
 * /
function _GMLfunc_draw_circle(xx, yy, r, outline) {
	return draw_circle(xx, yy, r, outline);
}
//*/

/* _GMLfunc_draw_ellipse(x1,y1,x2,y2,outline)
 * Wrapper for function: draw_ellipse.
 * /
function _GMLfunc_draw_ellipse(x1, y1, x2, y2, outline) {
	return draw_ellipse(x1, y1, x2, y2, outline);
}
//*/

/* _GMLfunc_draw_set_circle_precision(precision)
 * Wrapper for function: draw_set_circle_precision.
 * /
function _GMLfunc_draw_set_circle_precision(precision) {
	return draw_set_circle_precision(precision);
}
//*/

/* _GMLfunc_draw_arrow(x1,y1,x2,y2,size)
 * Wrapper for function: draw_arrow.
 * /
function _GMLfunc_draw_arrow(x1, y1, x2, y2, size) {
	return draw_arrow(x1, y1, x2, y2, size);
}
//*/

/* _GMLfunc_draw_button(x1,y1,x2,y2,up)
 * Wrapper for function: draw_button.
 * /
function _GMLfunc_draw_button(x1, y1, x2, y2, up) {
	return draw_button(x1, y1, x2, y2, up);
}
//*/

/* _GMLfunc_draw_path(path,xx,yy,absolute)
 * Wrapper for function: draw_path.
 * /
function _GMLfunc_draw_path(path, xx, yy, absolute) {
	return draw_path(path, xx, yy, absolute);
}
//*/

/* _GMLfunc_draw_healthbar(x1,y1,x2,y2,amount,backcol,mincol,maxcol,dir,showback,showborder)
 * Wrapper for function: draw_healthbar.
 * /
function _GMLfunc_draw_healthbar(x1, y1, x2, y2, amount, backcol, mincol, maxcol, dir, showback, showborder) {
	return draw_healthbar(x1, y1, x2, y2, amount, backcol, mincol, maxcol, dir, showback, showborder);
}
//*/

/* _GMLfunc_draw_getpixel(xx,yy)
 * Wrapper for function: draw_getpixel.
 * /
function _GMLfunc_draw_getpixel(xx, yy) {
	return draw_getpixel(xx, yy);
}
//*/

/* _GMLfunc_draw_set_color(col)
 * Wrapper for function: draw_set_color.
 * /
function _GMLfunc_draw_set_color(col) {
	return draw_set_color(col);
}
//*/

/* _GMLfunc_draw_set_alpha(alpha)
 * Wrapper for function: draw_set_alpha.
 * /
function _GMLfunc_draw_set_alpha(alpha) {
	return draw_set_alpha(alpha);
}
//*/

/* _GMLfunc_draw_get_color()
 * Wrapper for function: draw_get_color.
 * /
function _GMLfunc_draw_get_color() {
	return draw_get_color();
}
//*/

/* _GMLfunc_draw_get_alpha()
 * Wrapper for function: draw_get_alpha.
 * /
function _GMLfunc_draw_get_alpha() {
	return draw_get_alpha();
}
//*/

/* _GMLfunc_make_color_rgb(red,green,blue)
 * Wrapper for function: make_color_rgb.
 * /
function _GMLfunc_make_color_rgb(red, green, blue) {
	return make_color_rgb(red, green, blue);
}
//*/

/* _GMLfunc_make_color_hsv(hue,saturation,value)
 * Wrapper for function: make_color_hsv.
 * /
function _GMLfunc_make_color_hsv(hue, saturation, value) {
	return make_color_hsv(hue, saturation, value);
}
//*/

/* _GMLfunc_color_get_red(col)
 * Wrapper for function: color_get_red.
 * /
function _GMLfunc_color_get_red(col) {
	return color_get_red(col);
}
//*/

/* _GMLfunc_color_get_green(col)
 * Wrapper for function: color_get_green.
 * /
function _GMLfunc_color_get_green(col) {
	return color_get_green(col);
}
//*/

/* _GMLfunc_color_get_blue(col)
 * Wrapper for function: color_get_blue.
 * /
function _GMLfunc_color_get_blue(col) {
	return color_get_blue(col);
}
//*/

/* _GMLfunc_color_get_hue(col)
 * Wrapper for function: color_get_hue.
 * /
function _GMLfunc_color_get_hue(col) {
	return color_get_hue(col);
}
//*/

/* _GMLfunc_color_get_saturation(col)
 * Wrapper for function: color_get_saturation.
 * /
function _GMLfunc_color_get_saturation(col) {
	return color_get_saturation(col);
}
//*/

/* _GMLfunc_color_get_value(col)
 * Wrapper for function: color_get_value.
 * /
function _GMLfunc_color_get_value(col) {
	return color_get_value(col);
}
//*/

/* _GMLfunc_merge_color(col1,col2,amount)
 * Wrapper for function: merge_color.
 * /
function _GMLfunc_merge_color(col1, col2, amount) {
	return merge_color(col1, col2, amount);
}
//*/

/* _GMLfunc_screen_save(fname)
 * Wrapper for function: screen_save.
 * /
function _GMLfunc_screen_save(fname) {
	return screen_save(fname);
}
//*/

/* _GMLfunc_screen_save_part(fname,xx,yy,w,h)
 * Wrapper for function: screen_save_part.
 * /
function _GMLfunc_screen_save_part(fname, xx, yy, w, h) {
	return screen_save_part(fname, xx, yy, w, h);
}
//*/

/* _GMLfunc_draw_set_font(font)
 * Wrapper for function: draw_set_font.
 * /
function _GMLfunc_draw_set_font(font) {
	return draw_set_font(font);
}
//*/

/* _GMLfunc_draw_set_halign(halign)
 * Wrapper for function: draw_set_halign.
 * /
function _GMLfunc_draw_set_halign(halign) {
	return draw_set_halign(halign);
}
//*/

/* _GMLfunc_draw_set_valign(valign)
 * Wrapper for function: draw_set_valign.
 * /
function _GMLfunc_draw_set_valign(valign) {
	return draw_set_valign(valign);
}
//*/

/* _GMLfunc_draw_text(xx,yy,string)
 * Wrapper for function: draw_text.
 * /
function _GMLfunc_draw_text(xx, yy, string) {
	return draw_text(xx, yy, string);
}
//*/

/* _GMLfunc_draw_text_ext(xx,yy,string,sep,w)
 * Wrapper for function: draw_text_ext.
 * /
function _GMLfunc_draw_text_ext(xx, yy, string, sep, w) {
	return draw_text_ext(xx, yy, string, sep, w);
}
//*/

/* _GMLfunc_string_width(string)
 * Wrapper for function: string_width.
 * /
function _GMLfunc_string_width(string) {
	return string_width(string);
}
//*/

/* _GMLfunc_string_height(string)
 * Wrapper for function: string_height.
 * /
function _GMLfunc_string_height(string) {
	return string_height(string);
}
//*/

/* _GMLfunc_string_width_ext(string,sep,w)
 * Wrapper for function: string_width_ext.
 * /
function _GMLfunc_string_width_ext(string, sep, w) {
	return string_width_ext(string, sep, w);
}
//*/

/* _GMLfunc_string_height_ext(string,sep,w)
 * Wrapper for function: string_height_ext.
 * /
function _GMLfunc_string_height_ext(string, sep, w) {
	return string_height_ext(string, sep, w);
}
//*/

/* _GMLfunc_draw_text_transformed(xx,yy,string,xscale,yscale,angle)
 * Wrapper for function: draw_text_transformed.
 * /
function _GMLfunc_draw_text_transformed(xx, yy, string, xscale, yscale, angle) {
	return draw_text_transformed(xx, yy, string, xscale, yscale, angle);
}
//*/

/* _GMLfunc_draw_text_ext_transformed(xx,yy,string,sep,w,xscale,yscale,angle)
 * Wrapper for function: draw_text_ext_transformed.
 * /
function _GMLfunc_draw_text_ext_transformed(xx, yy, string, sep, w, xscale, yscale, angle) {
	return draw_text_ext_transformed(xx, yy, string, sep, w, xscale, yscale, angle);
}
//*/

/* _GMLfunc_draw_text_color(xx,yy,string,c1,c2,c3,c4,alpha)
 * Wrapper for function: draw_text_color.
 * /
function _GMLfunc_draw_text_color(xx, yy, string, c1, c2, c3, c4, alpha) {
	return draw_text_color(xx, yy, string, c1, c2, c3, c4, alpha);
}
//*/

/* _GMLfunc_draw_text_ext_color(xx,yy,string,sep,w,c1,c2,c3,c4,alpha)
 * Wrapper for function: draw_text_ext_color.
 * /
function _GMLfunc_draw_text_ext_color(xx, yy, string, sep, w, c1, c2, c3, c4, alpha) {
	return draw_text_ext_color(xx, yy, string, sep, w, c1, c2, c3, c4, alpha);
}
//*/

/* _GMLfunc_draw_text_transformed_color(xx,yy,string,xscale,yscale,angle,c1,c2,c3,c4,alpha)
 * Wrapper for function: draw_text_transformed_color.
 * /
function _GMLfunc_draw_text_transformed_color(xx, yy, string, xscale, yscale, angle, c1, c2, c3, c4, alpha) {
	return draw_text_transformed_color(xx, yy, string, xscale, yscale, angle, c1, c2, c3, c4, alpha);
}
//*/

/* _GMLfunc_draw_text_ext_transformed_color(xx,yy,string,sep,w,xscale,yscale,angle,c1,c2,c3,c4,alpha)
 * Wrapper for function: draw_text_ext_transformed_color.
 * /
function _GMLfunc_draw_text_ext_transformed_color(xx, yy, string, sep, w, xscale, yscale, angle, c1, c2, c3, c4, alpha) {
	return draw_text_ext_transformed_color(xx, yy, string, sep, w, xscale, yscale, angle, c1, c2, c3, c4, alpha);
}
//*/

/* _GMLfunc_draw_point_color(xx,yy,col1)
 * Wrapper for function: draw_point_color.
 * /
function _GMLfunc_draw_point_color(xx, yy, col1) {
	return draw_point_color(xx, yy, col1);
}
//*/

/* _GMLfunc_draw_line_color(x1,y1,x2,y2,col1,col2)
 * Wrapper for function: draw_line_color.
 * /
function _GMLfunc_draw_line_color(x1, y1, x2, y2, col1, col2) {
	return draw_line_color(x1, y1, x2, y2, col1, col2);
}
//*/

/* _GMLfunc_draw_line_width_color(x1,y1,x2,y2,w,col1,col2)
 * Wrapper for function: draw_line_width_color.
 * /
function _GMLfunc_draw_line_width_color(x1, y1, x2, y2, w, col1, col2) {
	return draw_line_width_color(x1, y1, x2, y2, w, col1, col2);
}
//*/

/* _GMLfunc_draw_rectangle_color(x1,y1,x2,y2,col1,col2,col3,col4,outline)
 * Wrapper for function: draw_rectangle_color.
 * /
function _GMLfunc_draw_rectangle_color(x1, y1, x2, y2, col1, col2, col3, col4, outline) {
	return draw_rectangle_color(x1, y1, x2, y2, col1, col2, col3, col4, outline);
}
//*/

/* _GMLfunc_draw_roundrect_color(x1,y1,x2,y2,col1,col2,outline)
 * Wrapper for function: draw_roundrect_color.
 * /
function _GMLfunc_draw_roundrect_color(x1, y1, x2, y2, col1, col2, outline) {
	return draw_roundrect_color(x1, y1, x2, y2, col1, col2, outline);
}
//*/

/* _GMLfunc_draw_triangle_color(x1,y1,x2,y2,x3,y3,col1,col2,col3,outline)
 * Wrapper for function: draw_triangle_color.
 * /
function _GMLfunc_draw_triangle_color(x1, y1, x2, y2, x3, y3, col1, col2, col3, outline) {
	return draw_triangle_color(x1, y1, x2, y2, x3, y3, col1, col2, col3, outline);
}
//*/

/* _GMLfunc_draw_circle_color(xx,yy,r,col1,col2,outline)
 * Wrapper for function: draw_circle_color.
 * /
function _GMLfunc_draw_circle_color(xx, yy, r, col1, col2, outline) {
	return draw_circle_color(xx, yy, r, col1, col2, outline);
}
//*/

/* _GMLfunc_draw_ellipse_color(x1,y1,x2,y2,col1,col2,outline)
 * Wrapper for function: draw_ellipse_color.
 * /
function _GMLfunc_draw_ellipse_color(x1, y1, x2, y2, col1, col2, outline) {
	return draw_ellipse_color(x1, y1, x2, y2, col1, col2, outline);
}
//*/

/* _GMLfunc_draw_primitive_begin(kind)
 * Wrapper for function: draw_primitive_begin.
 * /
function _GMLfunc_draw_primitive_begin(kind) {
	return draw_primitive_begin(kind);
}
//*/

/* _GMLfunc_draw_vertex(xx,yy)
 * Wrapper for function: draw_vertex.
 * /
function _GMLfunc_draw_vertex(xx, yy) {
	return draw_vertex(xx, yy);
}
//*/

/* _GMLfunc_draw_vertex_color(xx,yy,col,alpha)
 * Wrapper for function: draw_vertex_color.
 * /
function _GMLfunc_draw_vertex_color(xx, yy, col, alpha) {
	return draw_vertex_color(xx, yy, col, alpha);
}
//*/

/* _GMLfunc_draw_primitive_end()
 * Wrapper for function: draw_primitive_end.
 * /
function _GMLfunc_draw_primitive_end() {
	return draw_primitive_end();
}
//*/

/* _GMLfunc_sprite_get_texture(spr,subimg)
 * Wrapper for function: sprite_get_texture.
 * /
function _GMLfunc_sprite_get_texture(spr, subimg) {
	return sprite_get_texture(spr, subimg);
}
//*/

/* _GMLfunc_background_get_texture(back)
 * Wrapper for function: background_get_texture.
 * /
function _GMLfunc_background_get_texture(back) {
	return background_get_texture(back);
}
//*/

/* _GMLfunc_texture_preload(texid)
 * Wrapper for function: texture_preload.
 * /
function _GMLfunc_texture_preload(texid) {
	return texture_preload(texid);
}
//*/

/* _GMLfunc_texture_set_priority(texid,prio)
 * Wrapper for function: texture_set_priority.
 * /
function _GMLfunc_texture_set_priority(texid, prio) {
	return texture_set_priority(texid, prio);
}
//*/

/* _GMLfunc_texture_get_width(texid)
 * Wrapper for function: texture_get_width.
 * /
function _GMLfunc_texture_get_width(texid) {
	return texture_get_width(texid);
}
//*/

/* _GMLfunc_texture_get_height(texid)
 * Wrapper for function: texture_get_height.
 * /
function _GMLfunc_texture_get_height(texid) {
	return texture_get_height(texid);
}
//*/

/* _GMLfunc_draw_primitive_begin_texture(kind,texid)
 * Wrapper for function: draw_primitive_begin_texture.
 * /
function _GMLfunc_draw_primitive_begin_texture(kind, texid) {
	return draw_primitive_begin_texture(kind, texid);
}
//*/

/* _GMLfunc_draw_vertex_texture(xx,yy,xtex,ytex)
 * Wrapper for function: draw_vertex_texture.
 * /
function _GMLfunc_draw_vertex_texture(xx, yy, xtex, ytex) {
	return draw_vertex_texture(xx, yy, xtex, ytex);
}
//*/

/* _GMLfunc_draw_vertex_texture_color(xx,yy,xtex,ytex,col,alpha)
 * Wrapper for function: draw_vertex_texture_color.
 * /
function _GMLfunc_draw_vertex_texture_color(xx, yy, xtex, ytex, col, alpha) {
	return draw_vertex_texture_color(xx, yy, xtex, ytex, col, alpha);
}
//*/

/* _GMLfunc_texture_set_interpolation(linear)
 * Wrapper for function: texture_set_interpolation.
 * /
function _GMLfunc_texture_set_interpolation(linear) {
	return texture_set_interpolation(linear);
}
//*/

/* _GMLfunc_texture_set_blending(blend)
 * Wrapper for function: texture_set_blending.
 * /
function _GMLfunc_texture_set_blending(blend) {
	return texture_set_blending(blend);
}
//*/

/* _GMLfunc_texture_set_repeat(_repeat)
 * Wrapper for function: texture_set_repeat.
 * /
function _GMLfunc_texture_set_repeat(_repeat) {
	return texture_set_repeat(_repeat);
}
//*/

/* _GMLfunc_draw_set_blend_mode(mode)
 * Wrapper for function: draw_set_blend_mode.
 * /
function _GMLfunc_draw_set_blend_mode(mode) {
	return draw_set_blend_mode(mode);
}
//*/

/* _GMLfunc_draw_set_blend_mode_ext(src,dest)
 * Wrapper for function: draw_set_blend_mode_ext.
 * /
function _GMLfunc_draw_set_blend_mode_ext(src, dest) {
	return draw_set_blend_mode_ext(src, dest);
}
//*/

/* _GMLfunc_surface_create(w,h)
 * Wrapper for function: surface_create.
 * /
function _GMLfunc_surface_create(w, h) {
	return surface_create(w, h);
}
//*/

/* _GMLfunc_surface_free(_id)
 * Wrapper for function: surface_free.
 * /
function _GMLfunc_surface_free(_id) {
	return surface_free(_id);
}
//*/

/* _GMLfunc_surface_exists(_id)
 * Wrapper for function: surface_exists.
 * /
function _GMLfunc_surface_exists(_id) {
	return surface_exists(_id);
}
//*/

/* _GMLfunc_surface_get_width(_id)
 * Wrapper for function: surface_get_width.
 * /
function _GMLfunc_surface_get_width(_id) {
	return surface_get_width(_id);
}
//*/

/* _GMLfunc_surface_get_height(_id)
 * Wrapper for function: surface_get_height.
 * /
function _GMLfunc_surface_get_height(_id) {
	return surface_get_height(_id);
}
//*/

/* _GMLfunc_surface_get_texture(_id)
 * Wrapper for function: surface_get_texture.
 * /
function _GMLfunc_surface_get_texture(_id) {
	return surface_get_texture(_id);
}
//*/

/* _GMLfunc_surface_set_target(_id)
 * Wrapper for function: surface_set_target.
 * /
function _GMLfunc_surface_set_target(_id) {
	return surface_set_target(_id);
}
//*/

/* _GMLfunc_surface_reset_target()
 * Wrapper for function: surface_reset_target.
 * /
function _GMLfunc_surface_reset_target() {
	return surface_reset_target();
}
//*/

/* _GMLfunc_draw_surface(_id,xx,yy)
 * Wrapper for function: draw_surface.
 * /
function _GMLfunc_draw_surface(_id, xx, yy) {
	return draw_surface(_id, xx, yy);
}
//*/

/* _GMLfunc_draw_surface_stretched(_id,xx,yy,w,h)
 * Wrapper for function: draw_surface_stretched.
 * /
function _GMLfunc_draw_surface_stretched(_id, xx, yy, w, h) {
	return draw_surface_stretched(_id, xx, yy, w, h);
}
//*/

/* _GMLfunc_draw_surface_tiled(_id,xx,yy)
 * Wrapper for function: draw_surface_tiled.
 * /
function _GMLfunc_draw_surface_tiled(_id, xx, yy) {
	return draw_surface_tiled(_id, xx, yy);
}
//*/

/* _GMLfunc_draw_surface_part(_id,left,top,width,height,xx,yy)
 * Wrapper for function: draw_surface_part.
 * /
function _GMLfunc_draw_surface_part(_id, left, top, width, height, xx, yy) {
	return draw_surface_part(_id, left, top, width, height, xx, yy);
}
//*/

/* _GMLfunc_draw_surface_ext(_id,xx,yy,xscale,yscale,rot,color,alpha)
 * Wrapper for function: draw_surface_ext.
 * /
function _GMLfunc_draw_surface_ext(_id, xx, yy, xscale, yscale, rot, color, alpha) {
	return draw_surface_ext(_id, xx, yy, xscale, yscale, rot, color, alpha);
}
//*/

/* _GMLfunc_draw_surface_stretched_ext(_id,xx,yy,w,h,color,alpha)
 * Wrapper for function: draw_surface_stretched_ext.
 * /
function _GMLfunc_draw_surface_stretched_ext(_id, xx, yy, w, h, color, alpha) {
	return draw_surface_stretched_ext(_id, xx, yy, w, h, color, alpha);
}
//*/

/* _GMLfunc_draw_surface_tiled_ext(_id,xx,yy,xscale,yscale,color,alpha)
 * Wrapper for function: draw_surface_tiled_ext.
 * /
function _GMLfunc_draw_surface_tiled_ext(_id, xx, yy, xscale, yscale, color, alpha) {
	return draw_surface_tiled_ext(_id, xx, yy, xscale, yscale, color, alpha);
}
//*/

/* _GMLfunc_draw_surface_part_ext(_id,left,top,width,height,xx,yy,xscale,yscale,color,alpha)
 * Wrapper for function: draw_surface_part_ext.
 * /
function _GMLfunc_draw_surface_part_ext(_id, left, top, width, height, xx, yy, xscale, yscale, color, alpha) {
	return draw_surface_part_ext(_id, left, top, width, height, xx, yy, xscale, yscale, color, alpha);
}
//*/

/* _GMLfunc_draw_surface_general(_id,left,top,width,height,xx,yy,xscale,yscale,rot,c1,c2,c3,c4,alpha)
 * Wrapper for function: draw_surface_general.
 * /
function _GMLfunc_draw_surface_general(_id, left, top, width, height, xx, yy, xscale, yscale, rot, c1, c2, c3, c4, alpha) {
	return draw_surface_general(_id, left, top, width, height, xx, yy, xscale, yscale, rot, c1, c2, c3, c4, alpha);
}
//*/

/* _GMLfunc_surface_getpixel(_id,xx,yy)
 * Wrapper for function: surface_getpixel.
 * /
function _GMLfunc_surface_getpixel(_id, xx, yy) {
	return surface_getpixel(_id, xx, yy);
}
//*/

/* _GMLfunc_surface_save(_id,fname)
 * Wrapper for function: surface_save.
 * /
function _GMLfunc_surface_save(_id, fname) {
	return surface_save(_id, fname);
}
//*/

/* _GMLfunc_surface_save_part(_id,fname,xx,yy,w,h)
 * Wrapper for function: surface_save_part.
 * /
function _GMLfunc_surface_save_part(_id, fname, xx, yy, w, h) {
	return surface_save_part(_id, fname, xx, yy, w, h);
}
//*/

/* _GMLfunc_surface_copy(destination,xx,yy,source)
 * Wrapper for function: surface_copy.
 * /
function _GMLfunc_surface_copy(destination, xx, yy, source) {
	return surface_copy(destination, xx, yy, source);
}
//*/

/* _GMLfunc_surface_copy_part(destination,xx,yy,source,xs,ys,ws,hs)
 * Wrapper for function: surface_copy_part.
 * /
function _GMLfunc_surface_copy_part(destination, xx, yy, source, xs, ys, ws, hs) {
	return surface_copy_part(destination, xx, yy, source, xs, ys, ws, hs);
}
//*/

/* _GMLfunc_tile_add(background,left,top,width,height,xx,yy,_depth)
 * Wrapper for function: tile_add.
 * /
function _GMLfunc_tile_add(background, left, top, width, height, xx, yy, _depth) {
	return tile_add(background, left, top, width, height, xx, yy, _depth);
}
//*/

/* _GMLfunc_tile_delete(_id)
 * Wrapper for function: tile_delete.
 * /
function _GMLfunc_tile_delete(_id) {
	return tile_delete(_id);
}
//*/

/* _GMLfunc_tile_exists(_id)
 * Wrapper for function: tile_exists.
 * /
function _GMLfunc_tile_exists(_id) {
	return tile_exists(_id);
}
//*/

/* _GMLfunc_tile_get_x(_id)
 * Wrapper for function: tile_get_x.
 * /
function _GMLfunc_tile_get_x(_id) {
	return tile_get_x(_id);
}
//*/

/* _GMLfunc_tile_get_y(_id)
 * Wrapper for function: tile_get_y.
 * /
function _GMLfunc_tile_get_y(_id) {
	return tile_get_y(_id);
}
//*/

/* _GMLfunc_tile_get_left(_id)
 * Wrapper for function: tile_get_left.
 * /
function _GMLfunc_tile_get_left(_id) {
	return tile_get_left(_id);
}
//*/

/* _GMLfunc_tile_get_top(_id)
 * Wrapper for function: tile_get_top.
 * /
function _GMLfunc_tile_get_top(_id) {
	return tile_get_top(_id);
}
//*/

/* _GMLfunc_tile_get_width(_id)
 * Wrapper for function: tile_get_width.
 * /
function _GMLfunc_tile_get_width(_id) {
	return tile_get_width(_id);
}
//*/

/* _GMLfunc_tile_get_height(_id)
 * Wrapper for function: tile_get_height.
 * /
function _GMLfunc_tile_get_height(_id) {
	return tile_get_height(_id);
}
//*/

/* _GMLfunc_tile_get_depth(_id)
 * Wrapper for function: tile_get_depth.
 * /
function _GMLfunc_tile_get_depth(_id) {
	return tile_get_depth(_id);
}
//*/

/* _GMLfunc_tile_get_visible(_id)
 * Wrapper for function: tile_get_visible.
 * /
function _GMLfunc_tile_get_visible(_id) {
	return tile_get_visible(_id);
}
//*/

/* _GMLfunc_tile_get_xscale(_id)
 * Wrapper for function: tile_get_xscale.
 * /
function _GMLfunc_tile_get_xscale(_id) {
	return tile_get_xscale(_id);
}
//*/

/* _GMLfunc_tile_get_yscale(_id)
 * Wrapper for function: tile_get_yscale.
 * /
function _GMLfunc_tile_get_yscale(_id) {
	return tile_get_yscale(_id);
}
//*/

/* _GMLfunc_tile_get_background(_id)
 * Wrapper for function: tile_get_background.
 * /
function _GMLfunc_tile_get_background(_id) {
	return tile_get_background(_id);
}
//*/

/* _GMLfunc_tile_get_blend(_id)
 * Wrapper for function: tile_get_blend.
 * /
function _GMLfunc_tile_get_blend(_id) {
	return tile_get_blend(_id);
}
//*/

/* _GMLfunc_tile_get_alpha(_id)
 * Wrapper for function: tile_get_alpha.
 * /
function _GMLfunc_tile_get_alpha(_id) {
	return tile_get_alpha(_id);
}
//*/

/* _GMLfunc_tile_set_position(_id,xx,yy)
 * Wrapper for function: tile_set_position.
 * /
function _GMLfunc_tile_set_position(_id, xx, yy) {
	return tile_set_position(_id, xx, yy);
}
//*/

/* _GMLfunc_tile_set_region(_id,left,top,width,height)
 * Wrapper for function: tile_set_region.
 * /
function _GMLfunc_tile_set_region(_id, left, top, width, height) {
	return tile_set_region(_id, left, top, width, height);
}
//*/

/* _GMLfunc_tile_set_background(_id,background)
 * Wrapper for function: tile_set_background.
 * /
function _GMLfunc_tile_set_background(_id, background) {
	return tile_set_background(_id, background);
}
//*/

/* _GMLfunc_tile_set_visible(_id,_visible)
 * Wrapper for function: tile_set_visible.
 * /
function _GMLfunc_tile_set_visible(_id, _visible) {
	return tile_set_visible(_id, _visible);
}
//*/

/* _GMLfunc_tile_set_depth(_id,_depth)
 * Wrapper for function: tile_set_depth.
 * /
function _GMLfunc_tile_set_depth(_id, _depth) {
	return tile_set_depth(_id, _depth);
}
//*/

/* _GMLfunc_tile_set_scale(_id,xscale,yscale)
 * Wrapper for function: tile_set_scale.
 * /
function _GMLfunc_tile_set_scale(_id, xscale, yscale) {
	return tile_set_scale(_id, xscale, yscale);
}
//*/

/* _GMLfunc_tile_set_blend(_id,color)
 * Wrapper for function: tile_set_blend.
 * /
function _GMLfunc_tile_set_blend(_id, color) {
	return tile_set_blend(_id, color);
}
//*/

/* _GMLfunc_tile_set_alpha(_id,alpha)
 * Wrapper for function: tile_set_alpha.
 * /
function _GMLfunc_tile_set_alpha(_id, alpha) {
	return tile_set_alpha(_id, alpha);
}
//*/

/* _GMLfunc_tile_layer_hide(_depth)
 * Wrapper for function: tile_layer_hide.
 * /
function _GMLfunc_tile_layer_hide(_depth) {
	return tile_layer_hide(_depth);
}
//*/

/* _GMLfunc_tile_layer_show(_depth)
 * Wrapper for function: tile_layer_show.
 * /
function _GMLfunc_tile_layer_show(_depth) {
	return tile_layer_show(_depth);
}
//*/

/* _GMLfunc_tile_layer_delete(_depth)
 * Wrapper for function: tile_layer_delete.
 * /
function _GMLfunc_tile_layer_delete(_depth) {
	return tile_layer_delete(_depth);
}
//*/

/* _GMLfunc_tile_layer_shift(_depth,xx,yy)
 * Wrapper for function: tile_layer_shift.
 * /
function _GMLfunc_tile_layer_shift(_depth, xx, yy) {
	return tile_layer_shift(_depth, xx, yy);
}
//*/

/* _GMLfunc_tile_layer_find(_depth,xx,yy)
 * Wrapper for function: tile_layer_find.
 * /
function _GMLfunc_tile_layer_find(_depth, xx, yy) {
	return tile_layer_find(_depth, xx, yy);
}
//*/

/* _GMLfunc_tile_layer_delete_at(_depth,xx,yy)
 * Wrapper for function: tile_layer_delete_at.
 * /
function _GMLfunc_tile_layer_delete_at(_depth, xx, yy) {
	return tile_layer_delete_at(_depth, xx, yy);
}
//*/

/* _GMLfunc_tile_layer_depth(_depth,newdepth)
 * Wrapper for function: tile_layer_depth.
 * /
function _GMLfunc_tile_layer_depth(_depth, newdepth) {
	return tile_layer_depth(_depth, newdepth);
}
//*/

/* _GMLfunc_display_get_width()
 * Wrapper for function: display_get_width.
 * /
function _GMLfunc_display_get_width() {
	return display_get_width();
}
//*/

/* _GMLfunc_display_get_height()
 * Wrapper for function: display_get_height.
 * /
function _GMLfunc_display_get_height() {
	return display_get_height();
}
//*/

/* _GMLfunc_display_get_colordepth()
 * Wrapper for function: display_get_colordepth.
 * /
function _GMLfunc_display_get_colordepth() {
	return display_get_colordepth();
}
//*/

/* _GMLfunc_display_get_frequency()
 * Wrapper for function: display_get_frequency.
 * /
function _GMLfunc_display_get_frequency() {
	return display_get_frequency();
}
//*/

/* _GMLfunc_display_set_size(w,h)
 * Wrapper for function: display_set_size.
 * /
function _GMLfunc_display_set_size(w, h) {
	return display_set_size(w, h);
}
//*/

/* _GMLfunc_display_set_colordepth(coldepth)
 * Wrapper for function: display_set_colordepth.
 * /
function _GMLfunc_display_set_colordepth(coldepth) {
	return display_set_colordepth(coldepth);
}
//*/

/* _GMLfunc_display_set_frequency(frequency)
 * Wrapper for function: display_set_frequency.
 * /
function _GMLfunc_display_set_frequency(frequency) {
	return display_set_frequency(frequency);
}
//*/

/* _GMLfunc_display_set_all(w,h,frequency,coldepth)
 * Wrapper for function: display_set_all.
 * /
function _GMLfunc_display_set_all(w, h, frequency, coldepth) {
	return display_set_all(w, h, frequency, coldepth);
}
//*/

/* _GMLfunc_display_test_all(w,h,frequency,coldepth)
 * Wrapper for function: display_test_all.
 * /
function _GMLfunc_display_test_all(w, h, frequency, coldepth) {
	return display_test_all(w, h, frequency, coldepth);
}
//*/

/* _GMLfunc_display_reset()
 * Wrapper for function: display_reset.
 * /
function _GMLfunc_display_reset() {
	return display_reset();
}
//*/

/* _GMLfunc_display_mouse_get_x()
 * Wrapper for function: display_mouse_get_x.
 * /
function _GMLfunc_display_mouse_get_x() {
	return display_mouse_get_x();
}
//*/

/* _GMLfunc_display_mouse_get_y()
 * Wrapper for function: display_mouse_get_y.
 * /
function _GMLfunc_display_mouse_get_y() {
	return display_mouse_get_y();
}
//*/

/* _GMLfunc_display_mouse_set(xx,yy)
 * Wrapper for function: display_mouse_set.
 * /
function _GMLfunc_display_mouse_set(xx, yy) {
	return display_mouse_set(xx, yy);
}
//*/

/* _GMLfunc_window_set_visible(_visible)
 * Wrapper for function: window_set_visible.
 * /
function _GMLfunc_window_set_visible(_visible) {
	return window_set_visible(_visible);
}
//*/

/* _GMLfunc_window_get_visible()
 * Wrapper for function: window_get_visible.
 * /
function _GMLfunc_window_get_visible() {
	return window_get_visible();
}
//*/

/* _GMLfunc_window_set_fullscreen(full)
 * Wrapper for function: window_set_fullscreen.
 * /
function _GMLfunc_window_set_fullscreen(full) {
	return window_set_fullscreen(full);
}
//*/

/* _GMLfunc_window_get_fullscreen()
 * Wrapper for function: window_get_fullscreen.
 * /
function _GMLfunc_window_get_fullscreen() {
	return window_get_fullscreen();
}
//*/

/* _GMLfunc_window_set_showborder(show)
 * Wrapper for function: window_set_showborder.
 * /
function _GMLfunc_window_set_showborder(show) {
	return window_set_showborder(show);
}
//*/

/* _GMLfunc_window_get_showborder()
 * Wrapper for function: window_get_showborder.
 * /
function _GMLfunc_window_get_showborder() {
	return window_get_showborder();
}
//*/

/* _GMLfunc_window_set_showicons(show)
 * Wrapper for function: window_set_showicons.
 * /
function _GMLfunc_window_set_showicons(show) {
	return window_set_showicons(show);
}
//*/

/* _GMLfunc_window_get_showicons()
 * Wrapper for function: window_get_showicons.
 * /
function _GMLfunc_window_get_showicons() {
	return window_get_showicons();
}
//*/

/* _GMLfunc_window_set_stayontop(stay)
 * Wrapper for function: window_set_stayontop.
 * /
function _GMLfunc_window_set_stayontop(stay) {
	return window_set_stayontop(stay);
}
//*/

/* _GMLfunc_window_get_stayontop()
 * Wrapper for function: window_get_stayontop.
 * /
function _GMLfunc_window_get_stayontop() {
	return window_get_stayontop();
}
//*/

/* _GMLfunc_window_set_sizeable(sizeable)
 * Wrapper for function: window_set_sizeable.
 * /
function _GMLfunc_window_set_sizeable(sizeable) {
	return window_set_sizeable(sizeable);
}
//*/

/* _GMLfunc_window_get_sizeable()
 * Wrapper for function: window_get_sizeable.
 * /
function _GMLfunc_window_get_sizeable() {
	return window_get_sizeable();
}
//*/

/* _GMLfunc_window_set_caption(caption)
 * Wrapper for function: window_set_caption.
 * /
function _GMLfunc_window_set_caption(caption) {
	return window_set_caption(caption);
}
//*/

/* _GMLfunc_window_get_caption()
 * Wrapper for function: window_get_caption.
 * /
function _GMLfunc_window_get_caption() {
	return window_get_caption();
}
//*/

/* _GMLfunc_window_set_cursor(curs)
 * Wrapper for function: window_set_cursor.
 * /
function _GMLfunc_window_set_cursor(curs) {
	return window_set_cursor(curs);
}
//*/

/* _GMLfunc_window_get_cursor()
 * Wrapper for function: window_get_cursor.
 * /
function _GMLfunc_window_get_cursor() {
	return window_get_cursor();
}
//*/

/* _GMLfunc_window_set_color(color)
 * Wrapper for function: window_set_color.
 * /
function _GMLfunc_window_set_color(color) {
	return window_set_color(color);
}
//*/

/* _GMLfunc_window_get_color()
 * Wrapper for function: window_get_color.
 * /
function _GMLfunc_window_get_color() {
	return window_get_color();
}
//*/

/* _GMLfunc_window_set_region_scale(scale,adaptwindow)
 * Wrapper for function: window_set_region_scale.
 * /
function _GMLfunc_window_set_region_scale(scale, adaptwindow) {
	return window_set_region_scale(scale, adaptwindow);
}
//*/

/* _GMLfunc_window_get_region_scale()
 * Wrapper for function: window_get_region_scale.
 * /
function _GMLfunc_window_get_region_scale() {
	return window_get_region_scale();
}
//*/

/* _GMLfunc_window_set_position(xx,yy)
 * Wrapper for function: window_set_position.
 * /
function _GMLfunc_window_set_position(xx, yy) {
	return window_set_position(xx, yy);
}
//*/

/* _GMLfunc_window_set_size(w,h)
 * Wrapper for function: window_set_size.
 * /
function _GMLfunc_window_set_size(w, h) {
	return window_set_size(w, h);
}
//*/

/* _GMLfunc_window_set_rectangle(xx,yy,w,h)
 * Wrapper for function: window_set_rectangle.
 * /
function _GMLfunc_window_set_rectangle(xx, yy, w, h) {
	return window_set_rectangle(xx, yy, w, h);
}
//*/

/* _GMLfunc_window_center()
 * Wrapper for function: window_center.
 * /
function _GMLfunc_window_center() {
	return window_center();
}
//*/

/* _GMLfunc_window_default()
 * Wrapper for function: window_default.
 * /
function _GMLfunc_window_default() {
	return window_default();
}
//*/

/* _GMLfunc_window_get_x()
 * Wrapper for function: window_get_x.
 * /
function _GMLfunc_window_get_x() {
	return window_get_x();
}
//*/

/* _GMLfunc_window_get_y()
 * Wrapper for function: window_get_y.
 * /
function _GMLfunc_window_get_y() {
	return window_get_y();
}
//*/

/* _GMLfunc_window_get_width()
 * Wrapper for function: window_get_width.
 * /
function _GMLfunc_window_get_width() {
	return window_get_width();
}
//*/

/* _GMLfunc_window_get_height()
 * Wrapper for function: window_get_height.
 * /
function _GMLfunc_window_get_height() {
	return window_get_height();
}
//*/

/* _GMLfunc_window_mouse_get_x()
 * Wrapper for function: window_mouse_get_x.
 * /
function _GMLfunc_window_mouse_get_x() {
	return window_mouse_get_x();
}
//*/

/* _GMLfunc_window_mouse_get_y()
 * Wrapper for function: window_mouse_get_y.
 * /
function _GMLfunc_window_mouse_get_y() {
	return window_mouse_get_y();
}
//*/

/* _GMLfunc_window_mouse_set(xx,yy)
 * Wrapper for function: window_mouse_set.
 * /
function _GMLfunc_window_mouse_set(xx, yy) {
	return window_mouse_set(xx, yy);
}
//*/

/* _GMLfunc_window_set_region_size(w,h,adaptwindow)
 * Wrapper for function: window_set_region_size.
 * /
function _GMLfunc_window_set_region_size(w, h, adaptwindow) {
	return window_set_region_size(w, h, adaptwindow);
}
//*/

/* _GMLfunc_window_get_region_width()
 * Wrapper for function: window_get_region_width.
 * /
function _GMLfunc_window_get_region_width() {
	return window_get_region_width();
}
//*/

/* _GMLfunc_window_get_region_height()
 * Wrapper for function: window_get_region_height.
 * /
function _GMLfunc_window_get_region_height() {
	return window_get_region_height();
}
//*/

/* _GMLfunc_window_view_mouse_get_x(_id)
 * Wrapper for function: window_view_mouse_get_x.
 * /
function _GMLfunc_window_view_mouse_get_x(_id) {
	return window_view_mouse_get_x(_id);
}
//*/

/* _GMLfunc_window_view_mouse_get_y(_id)
 * Wrapper for function: window_view_mouse_get_y.
 * /
function _GMLfunc_window_view_mouse_get_y(_id) {
	return window_view_mouse_get_y(_id);
}
//*/

/* _GMLfunc_window_view_mouse_set(_id,xx,yy)
 * Wrapper for function: window_view_mouse_set.
 * /
function _GMLfunc_window_view_mouse_set(_id, xx, yy) {
	return window_view_mouse_set(_id, xx, yy);
}
//*/

/* _GMLfunc_window_views_mouse_get_x()
 * Wrapper for function: window_views_mouse_get_x.
 * /
function _GMLfunc_window_views_mouse_get_x() {
	return window_views_mouse_get_x();
}
//*/

/* _GMLfunc_window_views_mouse_get_y()
 * Wrapper for function: window_views_mouse_get_y.
 * /
function _GMLfunc_window_views_mouse_get_y() {
	return window_views_mouse_get_y();
}
//*/

/* _GMLfunc_window_views_mouse_set(xx,yy)
 * Wrapper for function: window_views_mouse_set.
 * /
function _GMLfunc_window_views_mouse_set(xx, yy) {
	return window_views_mouse_set(xx, yy);
}
//*/

/* _GMLfunc_screen_redraw()
 * Wrapper for function: screen_redraw.
 * /
function _GMLfunc_screen_redraw() {
	return screen_redraw();
}
//*/

/* _GMLfunc_screen_refresh()
 * Wrapper for function: screen_refresh.
 * /
function _GMLfunc_screen_refresh() {
	return screen_refresh();
}
//*/

/* _GMLfunc_screen_wait_vsync()
 * Wrapper for function: screen_wait_vsync.
 * /
function _GMLfunc_screen_wait_vsync() {
	return screen_wait_vsync();
}
//*/

/* _GMLfunc_set_automatic_draw(value)
 * Wrapper for function: set_automatic_draw.
 * /
function _GMLfunc_set_automatic_draw(value) {
	return set_automatic_draw(value);
}
//*/

/* _GMLfunc_set_synchronization(value)
 * Wrapper for function: set_synchronization.
 * /
function _GMLfunc_set_synchronization(value) {
	return set_synchronization(value);
}
//*/

/* _GMLfunc_sound_play(index)
 * Wrapper for function: sound_play.
 * /
function _GMLfunc_sound_play(index) {
	return sound_play(index);
}
//*/

/* _GMLfunc_sound_loop(index)
 * Wrapper for function: sound_loop.
 * /
function _GMLfunc_sound_loop(index) {
	return sound_loop(index);
}
//*/

/* _GMLfunc_sound_stop(index)
 * Wrapper for function: sound_stop.
 * /
function _GMLfunc_sound_stop(index) {
	return sound_stop(index);
}
//*/

/* _GMLfunc_sound_stop_all()
 * Wrapper for function: sound_stop_all.
 * /
function _GMLfunc_sound_stop_all() {
	return sound_stop_all();
}
//*/

/* _GMLfunc_sound_isplaying(index)
 * Wrapper for function: sound_isplaying.
 * /
function _GMLfunc_sound_isplaying(index) {
	return sound_isplaying(index);
}
//*/

/* _GMLfunc_sound_volume(index,value)
 * Wrapper for function: sound_volume.
 * /
function _GMLfunc_sound_volume(index, value) {
	return sound_volume(index, value);
}
//*/

/* _GMLfunc_sound_global_volume(value)
 * Wrapper for function: sound_global_volume.
 * /
function _GMLfunc_sound_global_volume(value) {
	return sound_global_volume(value);
}
//*/

/* _GMLfunc_sound_fade(index,value,time)
 * Wrapper for function: sound_fade.
 * /
function _GMLfunc_sound_fade(index, value, time) {
	return sound_fade(index, value, time);
}
//*/

/* _GMLfunc_sound_pan(index,value)
 * Wrapper for function: sound_pan.
 * /
function _GMLfunc_sound_pan(index, value) {
	return sound_pan(index, value);
}
//*/

/* _GMLfunc_sound_background_tempo(factor)
 * Wrapper for function: sound_background_tempo.
 * /
function _GMLfunc_sound_background_tempo(factor) {
	return sound_background_tempo(factor);
}
//*/

/* _GMLfunc_sound_set_search_directory(dir)
 * Wrapper for function: sound_set_search_directory.
 * /
function _GMLfunc_sound_set_search_directory(dir) {
	return sound_set_search_directory(dir);
}
//*/

/* _GMLfunc_sound_effect_set(snd,effect)
 * Wrapper for function: sound_effect_set.
 * /
function _GMLfunc_sound_effect_set(snd, effect) {
	return sound_effect_set(snd, effect);
}
//*/

/* _GMLfunc_sound_effect_chorus(snd,wetdry,_depth,feedback,frequency,wave,delay,phase)
 * Wrapper for function: sound_effect_chorus.
 * /
function _GMLfunc_sound_effect_chorus(snd, wetdry, _depth, feedback, frequency, wave, delay, phase) {
	return sound_effect_chorus(snd, wetdry, _depth, feedback, frequency, wave, delay, phase);
}
//*/

/* _GMLfunc_sound_effect_echo(snd,wetdry,feedback,leftdelay,rightdelay,pandelay)
 * Wrapper for function: sound_effect_echo.
 * /
function _GMLfunc_sound_effect_echo(snd, wetdry, feedback, leftdelay, rightdelay, pandelay) {
	return sound_effect_echo(snd, wetdry, feedback, leftdelay, rightdelay, pandelay);
}
//*/

/* _GMLfunc_sound_effect_flanger(snd,wetdry,_depth,feedback,frequency,wave,delay,phase)
 * Wrapper for function: sound_effect_flanger.
 * /
function _GMLfunc_sound_effect_flanger(snd, wetdry, _depth, feedback, frequency, wave, delay, phase) {
	return sound_effect_flanger(snd, wetdry, _depth, feedback, frequency, wave, delay, phase);
}
//*/

/* _GMLfunc_sound_effect_gargle(snd,rate,wave)
 * Wrapper for function: sound_effect_gargle.
 * /
function _GMLfunc_sound_effect_gargle(snd, rate, wave) {
	return sound_effect_gargle(snd, rate, wave);
}
//*/

/* _GMLfunc_sound_effect_reverb(snd,gain,mix,time,ratio)
 * Wrapper for function: sound_effect_reverb.
 * /
function _GMLfunc_sound_effect_reverb(snd, gain, mix, time, ratio) {
	return sound_effect_reverb(snd, gain, mix, time, ratio);
}
//*/

/* _GMLfunc_sound_effect_compressor(snd,gain,attack,release,threshold,ratio,delay)
 * Wrapper for function: sound_effect_compressor.
 * /
function _GMLfunc_sound_effect_compressor(snd, gain, attack, release, threshold, ratio, delay) {
	return sound_effect_compressor(snd, gain, attack, release, threshold, ratio, delay);
}
//*/

/* _GMLfunc_sound_effect_equalizer(snd,center,bandwidth,gain)
 * Wrapper for function: sound_effect_equalizer.
 * /
function _GMLfunc_sound_effect_equalizer(snd, center, bandwidth, gain) {
	return sound_effect_equalizer(snd, center, bandwidth, gain);
}
//*/

/* _GMLfunc_sound_3d_set_sound_position(snd,xx,yy,zz)
 * Wrapper for function: sound_3d_set_sound_position.
 * /
function _GMLfunc_sound_3d_set_sound_position(snd, xx, yy, zz) {
	return sound_3d_set_sound_position(snd, xx, yy, zz);
}
//*/

/* _GMLfunc_sound_3d_set_sound_velocity(snd,xx,yy,zz)
 * Wrapper for function: sound_3d_set_sound_velocity.
 * /
function _GMLfunc_sound_3d_set_sound_velocity(snd, xx, yy, zz) {
	return sound_3d_set_sound_velocity(snd, xx, yy, zz);
}
//*/

/* _GMLfunc_sound_3d_set_sound_distance(snd,mindist,maxdist)
 * Wrapper for function: sound_3d_set_sound_distance.
 * /
function _GMLfunc_sound_3d_set_sound_distance(snd, mindist, maxdist) {
	return sound_3d_set_sound_distance(snd, mindist, maxdist);
}
//*/

/* _GMLfunc_sound_3d_set_sound_cone(snd,xx,yy,zz,anglein,angleout,voloutside)
 * Wrapper for function: sound_3d_set_sound_cone.
 * /
function _GMLfunc_sound_3d_set_sound_cone(snd, xx, yy, zz, anglein, angleout, voloutside) {
	return sound_3d_set_sound_cone(snd, xx, yy, zz, anglein, angleout, voloutside);
}
//*/

/* _GMLfunc_cd_init()
 * Wrapper for function: cd_init.
 * /
function _GMLfunc_cd_init() {
	return cd_init();
}
//*/

/* _GMLfunc_cd_present()
 * Wrapper for function: cd_present.
 * /
function _GMLfunc_cd_present() {
	return cd_present();
}
//*/

/* _GMLfunc_cd_number()
 * Wrapper for function: cd_number.
 * /
function _GMLfunc_cd_number() {
	return cd_number();
}
//*/

/* _GMLfunc_cd_playing()
 * Wrapper for function: cd_playing.
 * /
function _GMLfunc_cd_playing() {
	return cd_playing();
}
//*/

/* _GMLfunc_cd_paused()
 * Wrapper for function: cd_paused.
 * /
function _GMLfunc_cd_paused() {
	return cd_paused();
}
//*/

/* _GMLfunc_cd_track()
 * Wrapper for function: cd_track.
 * /
function _GMLfunc_cd_track() {
	return cd_track();
}
//*/

/* _GMLfunc_cd_length()
 * Wrapper for function: cd_length.
 * /
function _GMLfunc_cd_length() {
	return cd_length();
}
//*/

/* _GMLfunc_cd_track_length(n)
 * Wrapper for function: cd_track_length.
 * /
function _GMLfunc_cd_track_length(n) {
	return cd_track_length(n);
}
//*/

/* _GMLfunc_cd_position()
 * Wrapper for function: cd_position.
 * /
function _GMLfunc_cd_position() {
	return cd_position();
}
//*/

/* _GMLfunc_cd_track_position()
 * Wrapper for function: cd_track_position.
 * /
function _GMLfunc_cd_track_position() {
	return cd_track_position();
}
//*/

/* _GMLfunc_cd_play(first,last)
 * Wrapper for function: cd_play.
 * /
function _GMLfunc_cd_play(first, last) {
	return cd_play(first, last);
}
//*/

/* _GMLfunc_cd_stop()
 * Wrapper for function: cd_stop.
 * /
function _GMLfunc_cd_stop() {
	return cd_stop();
}
//*/

/* _GMLfunc_cd_pause()
 * Wrapper for function: cd_pause.
 * /
function _GMLfunc_cd_pause() {
	return cd_pause();
}
//*/

/* _GMLfunc_cd_resume()
 * Wrapper for function: cd_resume.
 * /
function _GMLfunc_cd_resume() {
	return cd_resume();
}
//*/

/* _GMLfunc_cd_set_position(pos)
 * Wrapper for function: cd_set_position.
 * /
function _GMLfunc_cd_set_position(pos) {
	return cd_set_position(pos);
}
//*/

/* _GMLfunc_cd_set_track_position(pos)
 * Wrapper for function: cd_set_track_position.
 * /
function _GMLfunc_cd_set_track_position(pos) {
	return cd_set_track_position(pos);
}
//*/

/* _GMLfunc_cd_open_door()
 * Wrapper for function: cd_open_door.
 * /
function _GMLfunc_cd_open_door() {
	return cd_open_door();
}
//*/

/* _GMLfunc_cd_close_door()
 * Wrapper for function: cd_close_door.
 * /
function _GMLfunc_cd_close_door() {
	return cd_close_door();
}
//*/

/* _GMLfunc_MCI_command(str)
 * Wrapper for function: MCI_command.
 * /
function _GMLfunc_MCI_command(str) {
	return MCI_command(str);
}
//*/

/* _GMLfunc_splash_show_video(fname,loop)
 * Wrapper for function: splash_show_video.
 * /
function _GMLfunc_splash_show_video(fname, loop) {
	return splash_show_video(fname, loop);
}
//*/

/* _GMLfunc_splash_show_text(fname,delay)
 * Wrapper for function: splash_show_text.
 * /
function _GMLfunc_splash_show_text(fname, delay) {
	return splash_show_text(fname, delay);
}
//*/

/* _GMLfunc_splash_show_web(url,delay)
 * Wrapper for function: splash_show_web.
 * /
function _GMLfunc_splash_show_web(url, delay) {
	return splash_show_web(url, delay);
}
//*/

/* _GMLfunc_splash_show_image(fname,delay)
 * Wrapper for function: splash_show_image.
 * /
function _GMLfunc_splash_show_image(fname, delay) {
	return splash_show_image(fname, delay);
}
//*/

/* _GMLfunc_splash_set_caption(cap)
 * Wrapper for function: splash_set_caption.
 * /
function _GMLfunc_splash_set_caption(cap) {
	return splash_set_caption(cap);
}
//*/

/* _GMLfunc_splash_set_fullscreen(full)
 * Wrapper for function: splash_set_fullscreen.
 * /
function _GMLfunc_splash_set_fullscreen(full) {
	return splash_set_fullscreen(full);
}
//*/

/* _GMLfunc_splash_set_border(border)
 * Wrapper for function: splash_set_border.
 * /
function _GMLfunc_splash_set_border(border) {
	return splash_set_border(border);
}
//*/

/* _GMLfunc_splash_set_size(w,h)
 * Wrapper for function: splash_set_size.
 * /
function _GMLfunc_splash_set_size(w, h) {
	return splash_set_size(w, h);
}
//*/

/* _GMLfunc_splash_set_position(xx,yy)
 * Wrapper for function: splash_set_position.
 * /
function _GMLfunc_splash_set_position(xx, yy) {
	return splash_set_position(xx, yy);
}
//*/

/* _GMLfunc_splash_set_adapt(adapt)
 * Wrapper for function: splash_set_adapt.
 * /
function _GMLfunc_splash_set_adapt(adapt) {
	return splash_set_adapt(adapt);
}
//*/

/* _GMLfunc_splash_set_top(top)
 * Wrapper for function: splash_set_top.
 * /
function _GMLfunc_splash_set_top(top) {
	return splash_set_top(top);
}
//*/

/* _GMLfunc_splash_set_color(col)
 * Wrapper for function: splash_set_color.
 * /
function _GMLfunc_splash_set_color(col) {
	return splash_set_color(col);
}
//*/

/* _GMLfunc_splash_set_main(main)
 * Wrapper for function: splash_set_main.
 * /
function _GMLfunc_splash_set_main(main) {
	return splash_set_main(main);
}
//*/

/* _GMLfunc_splash_set_scale(scale)
 * Wrapper for function: splash_set_scale.
 * /
function _GMLfunc_splash_set_scale(scale) {
	return splash_set_scale(scale);
}
//*/

/* _GMLfunc_splash_set_cursor(vis)
 * Wrapper for function: splash_set_cursor.
 * /
function _GMLfunc_splash_set_cursor(vis) {
	return splash_set_cursor(vis);
}
//*/

/* _GMLfunc_splash_set_interrupt(interrupt)
 * Wrapper for function: splash_set_interrupt.
 * /
function _GMLfunc_splash_set_interrupt(interrupt) {
	return splash_set_interrupt(interrupt);
}
//*/

/* _GMLfunc_splash_set_stop_key(stop)
 * Wrapper for function: splash_set_stop_key.
 * /
function _GMLfunc_splash_set_stop_key(stop) {
	return splash_set_stop_key(stop);
}
//*/

/* _GMLfunc_splash_set_stop_mouse(stop)
 * Wrapper for function: splash_set_stop_mouse.
 * /
function _GMLfunc_splash_set_stop_mouse(stop) {
	return splash_set_stop_mouse(stop);
}
//*/

/* _GMLfunc_splash_set_close_button(show)
 * Wrapper for function: splash_set_close_button.
 * /
function _GMLfunc_splash_set_close_button(show) {
	return splash_set_close_button(show);
}
//*/

/* _GMLfunc_show_info()
 * Wrapper for function: show_info.
 * /
function _GMLfunc_show_info() {
	return show_info();
}
//*/

/* _GMLfunc_load_info(fname)
 * Wrapper for function: load_info.
 * /
function _GMLfunc_load_info(fname) {
	return load_info(fname);
}
//*/

/* _GMLfunc_show_message(str)
 * Wrapper for function: show_message.
 * /
function _GMLfunc_show_message(str) {
	return show_message(str);
}
//*/

/* _GMLfunc_show_message_ext(str,but1,but2,but3)
 * Wrapper for function: show_message_ext.
 * /
function _GMLfunc_show_message_ext(str, but1, but2, but3) {
	return show_message_ext(str, but1, but2, but3);
}
//*/

/* _GMLfunc_show_question(str)
 * Wrapper for function: show_question.
 * /
function _GMLfunc_show_question(str) {
	return show_question(str);
}
//*/

/* _GMLfunc_get_integer(str,def)
 * Wrapper for function: get_integer.
 * /
function _GMLfunc_get_integer(str, def) {
	return get_integer(str, def);
}
//*/

/* _GMLfunc_get_string(str,def)
 * Wrapper for function: get_string.
 * /
function _GMLfunc_get_string(str, def) {
	return get_string(str, def);
}
//*/

/* _GMLfunc_message_background(back)
 * Wrapper for function: message_background.
 * /
function _GMLfunc_message_background(back) {
	return message_background(back);
}
//*/

/* _GMLfunc_message_button(sprite)
 * Wrapper for function: message_button.
 * /
function _GMLfunc_message_button(sprite) {
	return message_button(sprite);
}
//*/

/* _GMLfunc_message_alpha(alpha)
 * Wrapper for function: message_alpha.
 * /
function _GMLfunc_message_alpha(alpha) {
	return message_alpha(alpha);
}
//*/

/* _GMLfunc_message_text_font(name,size,color,style)
 * Wrapper for function: message_text_font.
 * /
function _GMLfunc_message_text_font(name, size, color, style) {
	return message_text_font(name, size, color, style);
}
//*/

/* _GMLfunc_message_button_font(name,size,color,style)
 * Wrapper for function: message_button_font.
 * /
function _GMLfunc_message_button_font(name, size, color, style) {
	return message_button_font(name, size, color, style);
}
//*/

/* _GMLfunc_message_input_font(name,size,color,style)
 * Wrapper for function: message_input_font.
 * /
function _GMLfunc_message_input_font(name, size, color, style) {
	return message_input_font(name, size, color, style);
}
//*/

/* _GMLfunc_message_mouse_color(col)
 * Wrapper for function: message_mouse_color.
 * /
function _GMLfunc_message_mouse_color(col) {
	return message_mouse_color(col);
}
//*/

/* _GMLfunc_message_input_color(col)
 * Wrapper for function: message_input_color.
 * /
function _GMLfunc_message_input_color(col) {
	return message_input_color(col);
}
//*/

/* _GMLfunc_message_position(xx,yy)
 * Wrapper for function: message_position.
 * /
function _GMLfunc_message_position(xx, yy) {
	return message_position(xx, yy);
}
//*/

/* _GMLfunc_message_size(w,h)
 * Wrapper for function: message_size.
 * /
function _GMLfunc_message_size(w, h) {
	return message_size(w, h);
}
//*/

/* _GMLfunc_message_caption(show,str)
 * Wrapper for function: message_caption.
 * /
function _GMLfunc_message_caption(show, str) {
	return message_caption(show, str);
}
//*/

/* _GMLfunc_show_menu(str,def)
 * Wrapper for function: show_menu.
 * /
function _GMLfunc_show_menu(str, def) {
	return show_menu(str, def);
}
//*/

/* _GMLfunc_show_menu_pos(xx,yy,str,def)
 * Wrapper for function: show_menu_pos.
 * /
function _GMLfunc_show_menu_pos(xx, yy, str, def) {
	return show_menu_pos(xx, yy, str, def);
}
//*/

/* _GMLfunc_get_color(defcol)
 * Wrapper for function: get_color.
 * /
function _GMLfunc_get_color(defcol) {
	return get_color(defcol);
}
//*/

/* _GMLfunc_get_open_filename(filter,fname)
 * Wrapper for function: get_open_filename.
 * /
function _GMLfunc_get_open_filename(filter, fname) {
	return get_open_filename(filter, fname);
}
//*/

/* _GMLfunc_get_save_filename(filter,fname)
 * Wrapper for function: get_save_filename.
 * /
function _GMLfunc_get_save_filename(filter, fname) {
	return get_save_filename(filter, fname);
}
//*/

/* _GMLfunc_get_directory(dname)
 * Wrapper for function: get_directory.
 * /
function _GMLfunc_get_directory(dname) {
	return get_directory(dname);
}
//*/

/* _GMLfunc_get_directory_alt(capt,root)
 * Wrapper for function: get_directory_alt.
 * /
function _GMLfunc_get_directory_alt(capt, root) {
	return get_directory_alt(capt, root);
}
//*/

/* _GMLfunc_show_error(str,abort)
 * Wrapper for function: show_error.
 * /
function _GMLfunc_show_error(str, abort) {
	return show_error(str, abort);
}
//*/

/* _GMLfunc_highscore_show_ext(numb,back,border,col1,col2,name,size)
 * Wrapper for function: highscore_show_ext.
 * /
function _GMLfunc_highscore_show_ext(numb, back, border, col1, col2, name, size) {
	return highscore_show_ext(numb, back, border, col1, col2, name, size);
}
//*/

/* _GMLfunc_highscore_show(numb)
 * Wrapper for function: highscore_show.
 * /
function _GMLfunc_highscore_show(numb) {
	return highscore_show(numb);
}
//*/

/* _GMLfunc_highscore_set_background(back)
 * Wrapper for function: highscore_set_background.
 * /
function _GMLfunc_highscore_set_background(back) {
	return highscore_set_background(back);
}
//*/

/* _GMLfunc_highscore_set_border(show)
 * Wrapper for function: highscore_set_border.
 * /
function _GMLfunc_highscore_set_border(show) {
	return highscore_set_border(show);
}
//*/

/* _GMLfunc_highscore_set_font(name,size,style)
 * Wrapper for function: highscore_set_font.
 * /
function _GMLfunc_highscore_set_font(name, size, style) {
	return highscore_set_font(name, size, style);
}
//*/

/* _GMLfunc_highscore_set_strings(caption,nobody,escape)
 * Wrapper for function: highscore_set_strings.
 * /
function _GMLfunc_highscore_set_strings(caption, nobody, escape) {
	return highscore_set_strings(caption, nobody, escape);
}
//*/

/* _GMLfunc_highscore_set_colors(back,_new,_other)
 * Wrapper for function: highscore_set_colors.
 * /
function _GMLfunc_highscore_set_colors(back, _new, _other) {
	return highscore_set_colors(back, _new, _other);
}
//*/

/* _GMLfunc_highscore_clear()
 * Wrapper for function: highscore_clear.
 * /
function _GMLfunc_highscore_clear() {
	return highscore_clear();
}
//*/

/* _GMLfunc_highscore_add(str,numb)
 * Wrapper for function: highscore_add.
 * /
function _GMLfunc_highscore_add(str, numb) {
	return highscore_add(str, numb);
}
//*/

/* _GMLfunc_highscore_add_current()
 * Wrapper for function: highscore_add_current.
 * /
function _GMLfunc_highscore_add_current() {
	return highscore_add_current();
}
//*/

/* _GMLfunc_highscore_value(place)
 * Wrapper for function: highscore_value.
 * /
function _GMLfunc_highscore_value(place) {
	return highscore_value(place);
}
//*/

/* _GMLfunc_highscore_name(place)
 * Wrapper for function: highscore_name.
 * /
function _GMLfunc_highscore_name(place) {
	return highscore_name(place);
}
//*/

/* _GMLfunc_draw_highscore(x1,y1,x2,y2)
 * Wrapper for function: draw_highscore.
 * /
function _GMLfunc_draw_highscore(x1, y1, x2, y2) {
	return draw_highscore(x1, y1, x2, y2);
}
//*/

/* _GMLfunc_sprite_exists(ind)
 * Wrapper for function: sprite_exists.
 * /
function _GMLfunc_sprite_exists(ind) {
	return sprite_exists(ind);
}
//*/

/* _GMLfunc_sprite_get_name(ind)
 * Wrapper for function: sprite_get_name.
 * /
function _GMLfunc_sprite_get_name(ind) {
	return sprite_get_name(ind);
}
//*/

/* _GMLfunc_sprite_get_number(ind)
 * Wrapper for function: sprite_get_number.
 * /
function _GMLfunc_sprite_get_number(ind) {
	return sprite_get_number(ind);
}
//*/

/* _GMLfunc_sprite_get_width(ind)
 * Wrapper for function: sprite_get_width.
 * /
function _GMLfunc_sprite_get_width(ind) {
	return sprite_get_width(ind);
}
//*/

/* _GMLfunc_sprite_get_height(ind)
 * Wrapper for function: sprite_get_height.
 * /
function _GMLfunc_sprite_get_height(ind) {
	return sprite_get_height(ind);
}
//*/

/* _GMLfunc_sprite_get_xoffset(ind)
 * Wrapper for function: sprite_get_xoffset.
 * /
function _GMLfunc_sprite_get_xoffset(ind) {
	return sprite_get_xoffset(ind);
}
//*/

/* _GMLfunc_sprite_get_yoffset(ind)
 * Wrapper for function: sprite_get_yoffset.
 * /
function _GMLfunc_sprite_get_yoffset(ind) {
	return sprite_get_yoffset(ind);
}
//*/

/* _GMLfunc_sprite_get_bbox_left(ind)
 * Wrapper for function: sprite_get_bbox_left.
 * /
function _GMLfunc_sprite_get_bbox_left(ind) {
	return sprite_get_bbox_left(ind);
}
//*/

/* _GMLfunc_sprite_get_bbox_right(ind)
 * Wrapper for function: sprite_get_bbox_right.
 * /
function _GMLfunc_sprite_get_bbox_right(ind) {
	return sprite_get_bbox_right(ind);
}
//*/

/* _GMLfunc_sprite_get_bbox_top(ind)
 * Wrapper for function: sprite_get_bbox_top.
 * /
function _GMLfunc_sprite_get_bbox_top(ind) {
	return sprite_get_bbox_top(ind);
}
//*/

/* _GMLfunc_sprite_get_bbox_bottom(ind)
 * Wrapper for function: sprite_get_bbox_bottom.
 * /
function _GMLfunc_sprite_get_bbox_bottom(ind) {
	return sprite_get_bbox_bottom(ind);
}
//*/

/* _GMLfunc_sprite_save(ind,subimg,fname)
 * Wrapper for function: sprite_save.
 * /
function _GMLfunc_sprite_save(ind, subimg, fname) {
	return sprite_save(ind, subimg, fname);
}
//*/

/* _GMLfunc_sprite_save_strip(ind,fname)
 * Wrapper for function: sprite_save_strip.
 * /
function _GMLfunc_sprite_save_strip(ind, fname) {
	return sprite_save_strip(ind, fname);
}
//*/

/* _GMLfunc_sound_exists(ind)
 * Wrapper for function: sound_exists.
 * /
function _GMLfunc_sound_exists(ind) {
	return sound_exists(ind);
}
//*/

/* _GMLfunc_sound_get_name(ind)
 * Wrapper for function: sound_get_name.
 * /
function _GMLfunc_sound_get_name(ind) {
	return sound_get_name(ind);
}
//*/

/* _GMLfunc_sound_get_kind(ind)
 * Wrapper for function: sound_get_kind.
 * /
function _GMLfunc_sound_get_kind(ind) {
	return sound_get_kind(ind);
}
//*/

/* _GMLfunc_sound_get_preload(ind)
 * Wrapper for function: sound_get_preload.
 * /
function _GMLfunc_sound_get_preload(ind) {
	return sound_get_preload(ind);
}
//*/

/* _GMLfunc_sound_discard(ind)
 * Wrapper for function: sound_discard.
 * /
function _GMLfunc_sound_discard(ind) {
	return sound_discard(ind);
}
//*/

/* _GMLfunc_sound_restore(ind)
 * Wrapper for function: sound_restore.
 * /
function _GMLfunc_sound_restore(ind) {
	return sound_restore(ind);
}
//*/

/* _GMLfunc_background_exists(ind)
 * Wrapper for function: background_exists.
 * /
function _GMLfunc_background_exists(ind) {
	return background_exists(ind);
}
//*/

/* _GMLfunc_background_get_name(ind)
 * Wrapper for function: background_get_name.
 * /
function _GMLfunc_background_get_name(ind) {
	return background_get_name(ind);
}
//*/

/* _GMLfunc_background_get_width(ind)
 * Wrapper for function: background_get_width.
 * /
function _GMLfunc_background_get_width(ind) {
	return background_get_width(ind);
}
//*/

/* _GMLfunc_background_get_height(ind)
 * Wrapper for function: background_get_height.
 * /
function _GMLfunc_background_get_height(ind) {
	return background_get_height(ind);
}
//*/

/* _GMLfunc_background_save(ind,fname)
 * Wrapper for function: background_save.
 * /
function _GMLfunc_background_save(ind, fname) {
	return background_save(ind, fname);
}
//*/

/* _GMLfunc_font_exists(ind)
 * Wrapper for function: font_exists.
 * /
function _GMLfunc_font_exists(ind) {
	return font_exists(ind);
}
//*/

/* _GMLfunc_font_get_name(ind)
 * Wrapper for function: font_get_name.
 * /
function _GMLfunc_font_get_name(ind) {
	return font_get_name(ind);
}
//*/

/* _GMLfunc_font_get_fontname(ind)
 * Wrapper for function: font_get_fontname.
 * /
function _GMLfunc_font_get_fontname(ind) {
	return font_get_fontname(ind);
}
//*/

/* _GMLfunc_font_get_bold(ind)
 * Wrapper for function: font_get_bold.
 * /
function _GMLfunc_font_get_bold(ind) {
	return font_get_bold(ind);
}
//*/

/* _GMLfunc_font_get_italic(ind)
 * Wrapper for function: font_get_italic.
 * /
function _GMLfunc_font_get_italic(ind) {
	return font_get_italic(ind);
}
//*/

/* _GMLfunc_font_get_first(ind)
 * Wrapper for function: font_get_first.
 * /
function _GMLfunc_font_get_first(ind) {
	return font_get_first(ind);
}
//*/

/* _GMLfunc_font_get_last(ind)
 * Wrapper for function: font_get_last.
 * /
function _GMLfunc_font_get_last(ind) {
	return font_get_last(ind);
}
//*/

/* _GMLfunc_path_exists(ind)
 * Wrapper for function: path_exists.
 * /
function _GMLfunc_path_exists(ind) {
	return path_exists(ind);
}
//*/

/* _GMLfunc_path_get_name(ind)
 * Wrapper for function: path_get_name.
 * /
function _GMLfunc_path_get_name(ind) {
	return path_get_name(ind);
}
//*/

/* _GMLfunc_path_get_length(ind)
 * Wrapper for function: path_get_length.
 * /
function _GMLfunc_path_get_length(ind) {
	return path_get_length(ind);
}
//*/

/* _GMLfunc_path_get_kind(ind)
 * Wrapper for function: path_get_kind.
 * /
function _GMLfunc_path_get_kind(ind) {
	return path_get_kind(ind);
}
//*/

/* _GMLfunc_path_get_closed(ind)
 * Wrapper for function: path_get_closed.
 * /
function _GMLfunc_path_get_closed(ind) {
	return path_get_closed(ind);
}
//*/

/* _GMLfunc_path_get_precision(ind)
 * Wrapper for function: path_get_precision.
 * /
function _GMLfunc_path_get_precision(ind) {
	return path_get_precision(ind);
}
//*/

/* _GMLfunc_path_get_number(ind)
 * Wrapper for function: path_get_number.
 * /
function _GMLfunc_path_get_number(ind) {
	return path_get_number(ind);
}
//*/

/* _GMLfunc_path_get_point_x(ind,n)
 * Wrapper for function: path_get_point_x.
 * /
function _GMLfunc_path_get_point_x(ind, n) {
	return path_get_point_x(ind, n);
}
//*/

/* _GMLfunc_path_get_point_y(ind,n)
 * Wrapper for function: path_get_point_y.
 * /
function _GMLfunc_path_get_point_y(ind, n) {
	return path_get_point_y(ind, n);
}
//*/

/* _GMLfunc_path_get_point_speed(ind,n)
 * Wrapper for function: path_get_point_speed.
 * /
function _GMLfunc_path_get_point_speed(ind, n) {
	return path_get_point_speed(ind, n);
}
//*/

/* _GMLfunc_path_get_x(ind,pos)
 * Wrapper for function: path_get_x.
 * /
function _GMLfunc_path_get_x(ind, pos) {
	return path_get_x(ind, pos);
}
//*/

/* _GMLfunc_path_get_y(ind,pos)
 * Wrapper for function: path_get_y.
 * /
function _GMLfunc_path_get_y(ind, pos) {
	return path_get_y(ind, pos);
}
//*/

/* _GMLfunc_path_get_speed(ind,pos)
 * Wrapper for function: path_get_speed.
 * /
function _GMLfunc_path_get_speed(ind, pos) {
	return path_get_speed(ind, pos);
}
//*/

/* _GMLfunc_script_exists(ind)
 * Wrapper for function: script_exists.
 * /
function _GMLfunc_script_exists(ind) {
	return script_exists(ind);
}
//*/

/* _GMLfunc_script_get_name(ind)
 * Wrapper for function: script_get_name.
 * /
function _GMLfunc_script_get_name(ind) {
	return script_get_name(ind);
}
//*/

/* _GMLfunc_script_get_text(ind)
 * Wrapper for function: script_get_text.
 * /
function _GMLfunc_script_get_text(ind) {
	return script_get_text(ind);
}
//*/

/* _GMLfunc_timeline_exists(ind)
 * Wrapper for function: timeline_exists.
 * /
function _GMLfunc_timeline_exists(ind) {
	return timeline_exists(ind);
}
//*/

/* _GMLfunc_timeline_get_name(ind)
 * Wrapper for function: timeline_get_name.
 * /
function _GMLfunc_timeline_get_name(ind) {
	return timeline_get_name(ind);
}
//*/

/* _GMLfunc_object_exists(ind)
 * Wrapper for function: object_exists.
 * /
function _GMLfunc_object_exists(ind) {
	return object_exists(ind);
}
//*/

/* _GMLfunc_object_get_name(ind)
 * Wrapper for function: object_get_name.
 * /
function _GMLfunc_object_get_name(ind) {
	return object_get_name(ind);
}
//*/

/* _GMLfunc_object_get_sprite(ind)
 * Wrapper for function: object_get_sprite.
 * /
function _GMLfunc_object_get_sprite(ind) {
	return object_get_sprite(ind);
}
//*/

/* _GMLfunc_object_get_solid(ind)
 * Wrapper for function: object_get_solid.
 * /
function _GMLfunc_object_get_solid(ind) {
	return object_get_solid(ind);
}
//*/

/* _GMLfunc_object_get_visible(ind)
 * Wrapper for function: object_get_visible.
 * /
function _GMLfunc_object_get_visible(ind) {
	return object_get_visible(ind);
}
//*/

/* _GMLfunc_object_get_depth(ind)
 * Wrapper for function: object_get_depth.
 * /
function _GMLfunc_object_get_depth(ind) {
	return object_get_depth(ind);
}
//*/

/* _GMLfunc_object_get_persistent(ind)
 * Wrapper for function: object_get_persistent.
 * /
function _GMLfunc_object_get_persistent(ind) {
	return object_get_persistent(ind);
}
//*/

/* _GMLfunc_object_get_mask(ind)
 * Wrapper for function: object_get_mask.
 * /
function _GMLfunc_object_get_mask(ind) {
	return object_get_mask(ind);
}
//*/

/* _GMLfunc_object_get_parent(ind)
 * Wrapper for function: object_get_parent.
 * /
function _GMLfunc_object_get_parent(ind) {
	return object_get_parent(ind);
}
//*/

/* _GMLfunc_object_is_ancestor(ind1,ind2)
 * Wrapper for function: object_is_ancestor.
 * /
function _GMLfunc_object_is_ancestor(ind1, ind2) {
	return object_is_ancestor(ind1, ind2);
}
//*/

/* _GMLfunc_room_exists(ind)
 * Wrapper for function: room_exists.
 * /
function _GMLfunc_room_exists(ind) {
	return room_exists(ind);
}
//*/

/* _GMLfunc_room_get_name(ind)
 * Wrapper for function: room_get_name.
 * /
function _GMLfunc_room_get_name(ind) {
	return room_get_name(ind);
}
//*/

/* _GMLfunc_sprite_set_offset(ind,xoff,yoff)
 * Wrapper for function: sprite_set_offset.
 * /
function _GMLfunc_sprite_set_offset(ind, xoff, yoff) {
	return sprite_set_offset(ind, xoff, yoff);
}
//*/

/* _GMLfunc_sprite_duplicate(ind)
 * Wrapper for function: sprite_duplicate.
 * /
function _GMLfunc_sprite_duplicate(ind) {
	return sprite_duplicate(ind);
}
//*/

/* _GMLfunc_sprite_assign(ind,source)
 * Wrapper for function: sprite_assign.
 * /
function _GMLfunc_sprite_assign(ind, source) {
	return sprite_assign(ind, source);
}
//*/

/* _GMLfunc_sprite_merge(ind1,ind2)
 * Wrapper for function: sprite_merge.
 * /
function _GMLfunc_sprite_merge(ind1, ind2) {
	return sprite_merge(ind1, ind2);
}
//*/

/* _GMLfunc_sprite_add(fname,imgnumb,removeback,smooth,xorig,yorig)
 * Wrapper for function: sprite_add.
 * /
function _GMLfunc_sprite_add(fname, imgnumb, removeback, smooth, xorig, yorig) {
	return sprite_add(fname, imgnumb, removeback, smooth, xorig, yorig);
}
//*/

/* _GMLfunc_sprite_replace(ind,fname,imgnumb,removeback,smooth,xorig,yorig)
 * Wrapper for function: sprite_replace.
 * /
function _GMLfunc_sprite_replace(ind, fname, imgnumb, removeback, smooth, xorig, yorig) {
	return sprite_replace(ind, fname, imgnumb, removeback, smooth, xorig, yorig);
}
//*/

/* _GMLfunc_sprite_add_sprite(fname)
 * Wrapper for function: sprite_add_sprite.
 * /
function _GMLfunc_sprite_add_sprite(fname) {
	return sprite_add_sprite(fname);
}
//*/

/* _GMLfunc_sprite_replace_sprite(ind,fname)
 * Wrapper for function: sprite_replace_sprite.
 * /
function _GMLfunc_sprite_replace_sprite(ind, fname) {
	return sprite_replace_sprite(ind, fname);
}
//*/

/* _GMLfunc_sprite_create_from_screen(xx,yy,w,h,removeback,smooth,xorig,yorig)
 * Wrapper for function: sprite_create_from_screen.
 * /
function _GMLfunc_sprite_create_from_screen(xx, yy, w, h, removeback, smooth, xorig, yorig) {
	return sprite_create_from_screen(xx, yy, w, h, removeback, smooth, xorig, yorig);
}
//*/

/* _GMLfunc_sprite_add_from_screen(ind,xx,yy,w,h,removeback,smooth)
 * Wrapper for function: sprite_add_from_screen.
 * /
function _GMLfunc_sprite_add_from_screen(ind, xx, yy, w, h, removeback, smooth) {
	return sprite_add_from_screen(ind, xx, yy, w, h, removeback, smooth);
}
//*/

/* _GMLfunc_sprite_create_from_surface(_id,xx,yy,w,h,removeback,smooth,xorig,yorig)
 * Wrapper for function: sprite_create_from_surface.
 * /
function _GMLfunc_sprite_create_from_surface(_id, xx, yy, w, h, removeback, smooth, xorig, yorig) {
	return sprite_create_from_surface(_id, xx, yy, w, h, removeback, smooth, xorig, yorig);
}
//*/

/* _GMLfunc_sprite_add_from_surface(ind,_id,xx,yy,w,h,removeback,smooth)
 * Wrapper for function: sprite_add_from_surface.
 * /
function _GMLfunc_sprite_add_from_surface(ind, _id, xx, yy, w, h, removeback, smooth) {
	return sprite_add_from_surface(ind, _id, xx, yy, w, h, removeback, smooth);
}
//*/

/* _GMLfunc_sprite_delete(ind)
 * Wrapper for function: sprite_delete.
 * /
function _GMLfunc_sprite_delete(ind) {
	return sprite_delete(ind);
}
//*/

/* _GMLfunc_sprite_set_alpha_from_sprite(ind,spr)
 * Wrapper for function: sprite_set_alpha_from_sprite.
 * /
function _GMLfunc_sprite_set_alpha_from_sprite(ind, spr) {
	return sprite_set_alpha_from_sprite(ind, spr);
}
//*/

/* _GMLfunc_sprite_collision_mask(ind,sepmasks,bboxmode,bbleft,bbright,bbtop,bbbottom,kind,tolerance)
 * Wrapper for function: sprite_collision_mask.
 * /
function _GMLfunc_sprite_collision_mask(ind, sepmasks, bboxmode, bbleft, bbright, bbtop, bbbottom, kind, tolerance) {
	return sprite_collision_mask(ind, sepmasks, bboxmode, bbleft, bbright, bbtop, bbbottom, kind, tolerance);
}
//*/

/* _GMLfunc_sound_add(fname,kind,preload)
 * Wrapper for function: sound_add.
 * /
function _GMLfunc_sound_add(fname, kind, preload) {
	return sound_add(fname, kind, preload);
}
//*/

/* _GMLfunc_sound_replace(ind,fname,kind,preload)
 * Wrapper for function: sound_replace.
 * /
function _GMLfunc_sound_replace(ind, fname, kind, preload) {
	return sound_replace(ind, fname, kind, preload);
}
//*/

/* _GMLfunc_sound_delete(ind)
 * Wrapper for function: sound_delete.
 * /
function _GMLfunc_sound_delete(ind) {
	return sound_delete(ind);
}
//*/

/* _GMLfunc_background_duplicate(ind)
 * Wrapper for function: background_duplicate.
 * /
function _GMLfunc_background_duplicate(ind) {
	return background_duplicate(ind);
}
//*/

/* _GMLfunc_background_assign(ind,source)
 * Wrapper for function: background_assign.
 * /
function _GMLfunc_background_assign(ind, source) {
	return background_assign(ind, source);
}
//*/

/* _GMLfunc_background_add(fname,removeback,smooth)
 * Wrapper for function: background_add.
 * /
function _GMLfunc_background_add(fname, removeback, smooth) {
	return background_add(fname, removeback, smooth);
}
//*/

/* _GMLfunc_background_replace(ind,fname,removeback,smooth)
 * Wrapper for function: background_replace.
 * /
function _GMLfunc_background_replace(ind, fname, removeback, smooth) {
	return background_replace(ind, fname, removeback, smooth);
}
//*/

/* _GMLfunc_background_add_background(fname)
 * Wrapper for function: background_add_background.
 * /
function _GMLfunc_background_add_background(fname) {
	return background_add_background(fname);
}
//*/

/* _GMLfunc_background_replace_background(ind,fname)
 * Wrapper for function: background_replace_background.
 * /
function _GMLfunc_background_replace_background(ind, fname) {
	return background_replace_background(ind, fname);
}
//*/

/* _GMLfunc_background_create_color(w,h,col)
 * Wrapper for function: background_create_color.
 * /
function _GMLfunc_background_create_color(w, h, col) {
	return background_create_color(w, h, col);
}
//*/

/* _GMLfunc_background_create_gradient(w,h,col1,col2,kind)
 * Wrapper for function: background_create_gradient.
 * /
function _GMLfunc_background_create_gradient(w, h, col1, col2, kind) {
	return background_create_gradient(w, h, col1, col2, kind);
}
//*/

/* _GMLfunc_background_create_from_screen(xx,yy,w,h,removeback,smooth)
 * Wrapper for function: background_create_from_screen.
 * /
function _GMLfunc_background_create_from_screen(xx, yy, w, h, removeback, smooth) {
	return background_create_from_screen(xx, yy, w, h, removeback, smooth);
}
//*/

/* _GMLfunc_background_create_from_surface(_id,xx,yy,w,h,removeback,smooth)
 * Wrapper for function: background_create_from_surface.
 * /
function _GMLfunc_background_create_from_surface(_id, xx, yy, w, h, removeback, smooth) {
	return background_create_from_surface(_id, xx, yy, w, h, removeback, smooth);
}
//*/

/* _GMLfunc_background_delete(ind)
 * Wrapper for function: background_delete.
 * /
function _GMLfunc_background_delete(ind) {
	return background_delete(ind);
}
//*/

/* _GMLfunc_background_set_alpha_from_background(ind,back)
 * Wrapper for function: background_set_alpha_from_background.
 * /
function _GMLfunc_background_set_alpha_from_background(ind, back) {
	return background_set_alpha_from_background(ind, back);
}
//*/

/* _GMLfunc_font_add(name,size,bold,italic,first,last)
 * Wrapper for function: font_add.
 * /
function _GMLfunc_font_add(name, size, bold, italic, first, last) {
	return font_add(name, size, bold, italic, first, last);
}
//*/

/* _GMLfunc_font_add_sprite(spr,first,prop,sep)
 * Wrapper for function: font_add_sprite.
 * /
function _GMLfunc_font_add_sprite(spr, first, prop, sep) {
	return font_add_sprite(spr, first, prop, sep);
}
//*/

/* _GMLfunc_font_replace(ind,name,size,bold,italic,first,last)
 * Wrapper for function: font_replace.
 * /
function _GMLfunc_font_replace(ind, name, size, bold, italic, first, last) {
	return font_replace(ind, name, size, bold, italic, first, last);
}
//*/

/* _GMLfunc_font_replace_sprite(ind,spr,first,prop,sep)
 * Wrapper for function: font_replace_sprite.
 * /
function _GMLfunc_font_replace_sprite(ind, spr, first, prop, sep) {
	return font_replace_sprite(ind, spr, first, prop, sep);
}
//*/

/* _GMLfunc_font_delete(ind)
 * Wrapper for function: font_delete.
 * /
function _GMLfunc_font_delete(ind) {
	return font_delete(ind);
}
//*/

/* _GMLfunc_path_set_kind(ind,kind)
 * Wrapper for function: path_set_kind.
 * /
function _GMLfunc_path_set_kind(ind, kind) {
	return path_set_kind(ind, kind);
}
//*/

/* _GMLfunc_path_set_closed(ind,closed)
 * Wrapper for function: path_set_closed.
 * /
function _GMLfunc_path_set_closed(ind, closed) {
	return path_set_closed(ind, closed);
}
//*/

/* _GMLfunc_path_set_precision(ind,prec)
 * Wrapper for function: path_set_precision.
 * /
function _GMLfunc_path_set_precision(ind, prec) {
	return path_set_precision(ind, prec);
}
//*/

/* _GMLfunc_path_add()
 * Wrapper for function: path_add.
 * /
function _GMLfunc_path_add() {
	return path_add();
}
//*/

/* _GMLfunc_path_assign(ind,path)
 * Wrapper for function: path_assign.
 * /
function _GMLfunc_path_assign(ind, path) {
	return path_assign(ind, path);
}
//*/

/* _GMLfunc_path_duplicate(ind)
 * Wrapper for function: path_duplicate.
 * /
function _GMLfunc_path_duplicate(ind) {
	return path_duplicate(ind);
}
//*/

/* _GMLfunc_path_append(ind,path)
 * Wrapper for function: path_append.
 * /
function _GMLfunc_path_append(ind, path) {
	return path_append(ind, path);
}
//*/

/* _GMLfunc_path_delete(ind)
 * Wrapper for function: path_delete.
 * /
function _GMLfunc_path_delete(ind) {
	return path_delete(ind);
}
//*/

/* _GMLfunc_path_add_point(ind,xx,yy,spd)
 * Wrapper for function: path_add_point.
 * /
function _GMLfunc_path_add_point(ind, xx, yy, spd) {
	return path_add_point(ind, xx, yy, spd);
}
//*/

/* _GMLfunc_path_insert_point(ind,n,xx,yy,spd)
 * Wrapper for function: path_insert_point.
 * /
function _GMLfunc_path_insert_point(ind, n, xx, yy, spd) {
	return path_insert_point(ind, n, xx, yy, spd);
}
//*/

/* _GMLfunc_path_change_point(ind,n,xx,yy,spd)
 * Wrapper for function: path_change_point.
 * /
function _GMLfunc_path_change_point(ind, n, xx, yy, spd) {
	return path_change_point(ind, n, xx, yy, spd);
}
//*/

/* _GMLfunc_path_delete_point(ind,n)
 * Wrapper for function: path_delete_point.
 * /
function _GMLfunc_path_delete_point(ind, n) {
	return path_delete_point(ind, n);
}
//*/

/* _GMLfunc_path_clear_points(ind)
 * Wrapper for function: path_clear_points.
 * /
function _GMLfunc_path_clear_points(ind) {
	return path_clear_points(ind);
}
//*/

/* _GMLfunc_path_reverse(ind)
 * Wrapper for function: path_reverse.
 * /
function _GMLfunc_path_reverse(ind) {
	return path_reverse(ind);
}
//*/

/* _GMLfunc_path_mirror(ind)
 * Wrapper for function: path_mirror.
 * /
function _GMLfunc_path_mirror(ind) {
	return path_mirror(ind);
}
//*/

/* _GMLfunc_path_flip(ind)
 * Wrapper for function: path_flip.
 * /
function _GMLfunc_path_flip(ind) {
	return path_flip(ind);
}
//*/

/* _GMLfunc_path_rotate(ind,angle)
 * Wrapper for function: path_rotate.
 * /
function _GMLfunc_path_rotate(ind, angle) {
	return path_rotate(ind, angle);
}
//*/

/* _GMLfunc_path_scale(ind,xscale,yscale)
 * Wrapper for function: path_scale.
 * /
function _GMLfunc_path_scale(ind, xscale, yscale) {
	return path_scale(ind, xscale, yscale);
}
//*/

/* _GMLfunc_path_shift(ind,xshift,yshift)
 * Wrapper for function: path_shift.
 * /
function _GMLfunc_path_shift(ind, xshift, yshift) {
	return path_shift(ind, xshift, yshift);
}
//*/

/* _GMLfunc_execute_string(str,arg0,arg1,...)
 * Wrapper for function: execute_string.
 * /
function _GMLfunc_execute_string(str, arg0, arg1, ...) {
	switch (arguments.length) {
	case 0:
		return 0;
		break;
	case 1:
		return _execute_string(str);
		break;
	case 2:
		return _execute_string(str, arguments[1]);
		break;
	case 3:
		return _execute_string(str, arguments[1], arguments[2]);
		break;
	case 4:
		return _execute_string(str, arguments[1], arguments[2], arguments[3]);
		break;
	case 5:
		return _execute_string(str, arguments[1], arguments[2], arguments[3], arguments[4]);
		break;
	case 6:
		return _execute_string(str, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
		break;
	case 7:
		return _execute_string(str, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6]);
		break;
	case 8:
		return _execute_string(str, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7]);
		break;
	case 9:
		return _execute_string(str, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8]);
		break;
	case 10:
		return _execute_string(str, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9]);
		break;
	case 11:
		return _execute_string(str, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10]);
		break;
	case 12:
		return _execute_string(str, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11]);
		break;
	case 13:
		return _execute_string(str, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12]);
		break;
	case 14:
		return _execute_string(str, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13]);
		break;
	case 15:
		return _execute_string(str, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14]);
		break;
	case 16:
		return _execute_string(str, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14], arguments[15]);
		break;
	default:
		return 0;
		break;
	}
}
//*/

/* _GMLfunc_execute_file(fname,arg0,arg1,...)
 * Wrapper for function: execute_file.
 * /
function _GMLfunc_execute_file(fname, arg0, arg1, ...) {
	switch (arguments.length) {
	case 0:
		return 0;
		break;
	case 1:
		return _execute_file(fname);
		break;
	case 2:
		return _execute_file(fname, arguments[1]);
		break;
	case 3:
		return _execute_file(fname, arguments[1], arguments[2]);
		break;
	case 4:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3]);
		break;
	case 5:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3], arguments[4]);
		break;
	case 6:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
		break;
	case 7:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6]);
		break;
	case 8:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7]);
		break;
	case 9:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8]);
		break;
	case 10:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9]);
		break;
	case 11:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10]);
		break;
	case 12:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11]);
		break;
	case 13:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12]);
		break;
	case 14:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13]);
		break;
	case 15:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14]);
		break;
	case 16:
		return _execute_file(fname, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14], arguments[15]);
		break;
	default:
		return 0;
		break;
	}
}
//*/

/* _GMLfunc_script_execute(ind,arg0,arg1,...)
 * Wrapper for function: script_execute.
 * /
function _GMLfunc_script_execute(ind, arg0, arg1, ...) {
	switch (arguments.length) {
	case 0:
		return 0;
		break;
	case 1:
		return script_execute(ind);
		break;
	case 2:
		return script_execute(ind, arguments[1]);
		break;
	case 3:
		return script_execute(ind, arguments[1], arguments[2]);
		break;
	case 4:
		return script_execute(ind, arguments[1], arguments[2], arguments[3]);
		break;
	case 5:
		return script_execute(ind, arguments[1], arguments[2], arguments[3], arguments[4]);
		break;
	case 6:
		return script_execute(ind, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
		break;
	case 7:
		return script_execute(ind, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6]);
		break;
	case 8:
		return script_execute(ind, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7]);
		break;
	case 9:
		return script_execute(ind, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8]);
		break;
	case 10:
		return script_execute(ind, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9]);
		break;
	case 11:
		return script_execute(ind, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10]);
		break;
	case 12:
		return script_execute(ind, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11]);
		break;
	case 13:
		return script_execute(ind, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12]);
		break;
	case 14:
		return script_execute(ind, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13]);
		break;
	case 15:
		return script_execute(ind, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14]);
		break;
	case 16:
		return script_execute(ind, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14], arguments[15]);
		break;
	default:
		return 0;
		break;
	}
}
//*/

/* _GMLfunc_timeline_add()
 * Wrapper for function: timeline_add.
 * /
function _GMLfunc_timeline_add() {
	return timeline_add();
}
//*/

/* _GMLfunc_timeline_delete(ind)
 * Wrapper for function: timeline_delete.
 * /
function _GMLfunc_timeline_delete(ind) {
	return timeline_delete(ind);
}
//*/

/* _GMLfunc_timeline_clear(ind)
 * Wrapper for function: timeline_clear.
 * /
function _GMLfunc_timeline_clear(ind) {
	return timeline_clear(ind);
}
//*/

/* _GMLfunc_timeline_moment_clear(ind,step)
 * Wrapper for function: timeline_moment_clear.
 * /
function _GMLfunc_timeline_moment_clear(ind, step) {
	return timeline_moment_clear(ind, step);
}
//*/

/* _GMLfunc_timeline_moment_add(ind,step,codestr)
 * Wrapper for function: timeline_moment_add.
 * /
function _GMLfunc_timeline_moment_add(ind, step, codestr) {
	return timeline_moment_add(ind, step, codestr);
}
//*/

/* _GMLfunc_object_set_sprite(ind,spr)
 * Wrapper for function: object_set_sprite.
 * /
function _GMLfunc_object_set_sprite(ind, spr) {
	return object_set_sprite(ind, spr);
}
//*/

/* _GMLfunc_object_set_solid(ind,_solid)
 * Wrapper for function: object_set_solid.
 * /
function _GMLfunc_object_set_solid(ind, _solid) {
	return object_set_solid(ind, _solid);
}
//*/

/* _GMLfunc_object_set_visible(ind,vis)
 * Wrapper for function: object_set_visible.
 * /
function _GMLfunc_object_set_visible(ind, vis) {
	return object_set_visible(ind, vis);
}
//*/

/* _GMLfunc_object_set_depth(ind,_depth)
 * Wrapper for function: object_set_depth.
 * /
function _GMLfunc_object_set_depth(ind, _depth) {
	return object_set_depth(ind, _depth);
}
//*/

/* _GMLfunc_object_set_persistent(ind,pers)
 * Wrapper for function: object_set_persistent.
 * /
function _GMLfunc_object_set_persistent(ind, pers) {
	return object_set_persistent(ind, pers);
}
//*/

/* _GMLfunc_object_set_mask(ind,spr)
 * Wrapper for function: object_set_mask.
 * /
function _GMLfunc_object_set_mask(ind, spr) {
	return object_set_mask(ind, spr);
}
//*/

/* _GMLfunc_object_set_parent(ind,obj)
 * Wrapper for function: object_set_parent.
 * /
function _GMLfunc_object_set_parent(ind, obj) {
	return object_set_parent(ind, obj);
}
//*/

/* _GMLfunc_object_add()
 * Wrapper for function: object_add.
 * /
function _GMLfunc_object_add() {
	return object_add();
}
//*/

/* _GMLfunc_object_delete(ind)
 * Wrapper for function: object_delete.
 * /
function _GMLfunc_object_delete(ind) {
	return object_delete(ind);
}
//*/

/* _GMLfunc_object_event_clear(ind,evtype,evnumb)
 * Wrapper for function: object_event_clear.
 * /
function _GMLfunc_object_event_clear(ind, evtype, evnumb) {
	return object_event_clear(ind, evtype, evnumb);
}
//*/

/* _GMLfunc_object_event_add(ind,evtype,evnumb,codestr)
 * Wrapper for function: object_event_add.
 * /
function _GMLfunc_object_event_add(ind, evtype, evnumb, codestr) {
	return object_event_add(ind, evtype, evnumb, codestr);
}
//*/

/* _GMLfunc_room_set_width(ind,w)
 * Wrapper for function: room_set_width.
 * /
function _GMLfunc_room_set_width(ind, w) {
	return room_set_width(ind, w);
}
//*/

/* _GMLfunc_room_set_height(ind,h)
 * Wrapper for function: room_set_height.
 * /
function _GMLfunc_room_set_height(ind, h) {
	return room_set_height(ind, h);
}
//*/

/* _GMLfunc_room_set_caption(ind,str)
 * Wrapper for function: room_set_caption.
 * /
function _GMLfunc_room_set_caption(ind, str) {
	return room_set_caption(ind, str);
}
//*/

/* _GMLfunc_room_set_persistent(ind,pers)
 * Wrapper for function: room_set_persistent.
 * /
function _GMLfunc_room_set_persistent(ind, pers) {
	return room_set_persistent(ind, pers);
}
//*/

/* _GMLfunc_room_set_code(ind,codestr)
 * Wrapper for function: room_set_code.
 * /
function _GMLfunc_room_set_code(ind, codestr) {
	return room_set_code(ind, codestr);
}
//*/

/* _GMLfunc_room_set_background_color(ind,col,show)
 * Wrapper for function: room_set_background_color.
 * /
function _GMLfunc_room_set_background_color(ind, col, show) {
	return room_set_background_color(ind, col, show);
}
//*/

/* _GMLfunc_room_set_background(ind,bind,vis,fore,back,xx,yy,htiled,vtiled,hspd,vspd,alpha)
 * Wrapper for function: room_set_background.
 * /
function _GMLfunc_room_set_background(ind, bind, vis, fore, back, xx, yy, htiled, vtiled, hspd, vspd, alpha) {
	return room_set_background(ind, bind, vis, fore, back, xx, yy, htiled, vtiled, hspd, vspd, alpha);
}
//*/

/* _GMLfunc_room_set_view(ind,vind,vis,xview,yview,wview,hview,xport,yport,wport,hport,hborder,vborder,hspd,vspd,obj)
 * Wrapper for function: room_set_view.
 * /
function _GMLfunc_room_set_view(ind, vind, vis, xview, yview, wview, hview, xport, yport, wport, hport, hborder, vborder, hspd, vspd, obj) {
	return room_set_view(ind, vind, vis, xview, yview, wview, hview, xport, yport, wport, hport, hborder, vborder, hspd, vspd, obj);
}
//*/

/* _GMLfunc_room_set_view_enabled(ind,val)
 * Wrapper for function: room_set_view_enabled.
 * /
function _GMLfunc_room_set_view_enabled(ind, val) {
	return room_set_view_enabled(ind, val);
}
//*/

/* _GMLfunc_room_add()
 * Wrapper for function: room_add.
 * /
function _GMLfunc_room_add() {
	return room_add();
}
//*/

/* _GMLfunc_room_duplicate(ind)
 * Wrapper for function: room_duplicate.
 * /
function _GMLfunc_room_duplicate(ind) {
	return room_duplicate(ind);
}
//*/

/* _GMLfunc_room_assign(ind,source)
 * Wrapper for function: room_assign.
 * /
function _GMLfunc_room_assign(ind, source) {
	return room_assign(ind, source);
}
//*/

/* _GMLfunc_room_instance_add(ind,xx,yy,obj)
 * Wrapper for function: room_instance_add.
 * /
function _GMLfunc_room_instance_add(ind, xx, yy, obj) {
	return room_instance_add(ind, xx, yy, obj);
}
//*/

/* _GMLfunc_room_instance_clear(ind)
 * Wrapper for function: room_instance_clear.
 * /
function _GMLfunc_room_instance_clear(ind) {
	return room_instance_clear(ind);
}
//*/

/* _GMLfunc_room_tile_add(ind,back,left,top,width,height,xx,yy,_depth)
 * Wrapper for function: room_tile_add.
 * /
function _GMLfunc_room_tile_add(ind, back, left, top, width, height, xx, yy, _depth) {
	return room_tile_add(ind, back, left, top, width, height, xx, yy, _depth);
}
//*/

/* _GMLfunc_room_tile_add_ext(ind,back,left,top,width,height,xx,yy,_depth,xscale,yscale,alpha)
 * Wrapper for function: room_tile_add_ext.
 * /
function _GMLfunc_room_tile_add_ext(ind, back, left, top, width, height, xx, yy, _depth, xscale, yscale, alpha) {
	return room_tile_add_ext(ind, back, left, top, width, height, xx, yy, _depth, xscale, yscale, alpha);
}
//*/

/* _GMLfunc_room_tile_clear(ind)
 * Wrapper for function: room_tile_clear.
 * /
function _GMLfunc_room_tile_clear(ind) {
	return room_tile_clear(ind);
}
//*/

/* _GMLfunc_file_text_open_read(fname)
 * Wrapper for function: file_text_open_read.
 * /
function _GMLfunc_file_text_open_read(fname) {
	return file_text_open_read(fname);
}
//*/

/* _GMLfunc_file_text_open_write(fname)
 * Wrapper for function: file_text_open_write.
 * /
function _GMLfunc_file_text_open_write(fname) {
	return file_text_open_write(fname);
}
//*/

/* _GMLfunc_file_text_open_append(fname)
 * Wrapper for function: file_text_open_append.
 * /
function _GMLfunc_file_text_open_append(fname) {
	return file_text_open_append(fname);
}
//*/

/* _GMLfunc_file_text_close(file)
 * Wrapper for function: file_text_close.
 * /
function _GMLfunc_file_text_close(file) {
	return file_text_close(file);
}
//*/

/* _GMLfunc_file_text_write_string(file,str)
 * Wrapper for function: file_text_write_string.
 * /
function _GMLfunc_file_text_write_string(file, str) {
	return file_text_write_string(file, str);
}
//*/

/* _GMLfunc_file_text_write_real(file,val)
 * Wrapper for function: file_text_write_real.
 * /
function _GMLfunc_file_text_write_real(file, val) {
	return file_text_write_real(file, val);
}
//*/

/* _GMLfunc_file_text_writeln(file)
 * Wrapper for function: file_text_writeln.
 * /
function _GMLfunc_file_text_writeln(file) {
	return file_text_writeln(file);
}
//*/

/* _GMLfunc_file_text_read_string(file)
 * Wrapper for function: file_text_read_string.
 * /
function _GMLfunc_file_text_read_string(file) {
	return file_text_read_string(file);
}
//*/

/* _GMLfunc_file_text_read_real(file)
 * Wrapper for function: file_text_read_real.
 * /
function _GMLfunc_file_text_read_real(file) {
	return file_text_read_real(file);
}
//*/

/* _GMLfunc_file_text_readln(file)
 * Wrapper for function: file_text_readln.
 * /
function _GMLfunc_file_text_readln(file) {
	return file_text_readln(file);
}
//*/

/* _GMLfunc_file_text_eof(file)
 * Wrapper for function: file_text_eof.
 * /
function _GMLfunc_file_text_eof(file) {
	return file_text_eof(file);
}
//*/

/* _GMLfunc_file_text_eoln(file)
 * Wrapper for function: file_text_eoln.
 * /
function _GMLfunc_file_text_eoln(file) {
	return file_text_eoln(file);
}
//*/

/* _GMLfunc_file_exists(fname)
 * Wrapper for function: file_exists.
 * /
function _GMLfunc_file_exists(fname) {
	return file_exists(fname);
}
//*/

/* _GMLfunc_file_delete(fname)
 * Wrapper for function: file_delete.
 * /
function _GMLfunc_file_delete(fname) {
	return file_delete(fname);
}
//*/

/* _GMLfunc_file_rename(oldname,newname)
 * Wrapper for function: file_rename.
 * /
function _GMLfunc_file_rename(oldname, newname) {
	return file_rename(oldname, newname);
}
//*/

/* _GMLfunc_file_copy(fname,newname)
 * Wrapper for function: file_copy.
 * /
function _GMLfunc_file_copy(fname, newname) {
	return file_copy(fname, newname);
}
//*/

/* _GMLfunc_directory_exists(dname)
 * Wrapper for function: directory_exists.
 * /
function _GMLfunc_directory_exists(dname) {
	return directory_exists(dname);
}
//*/

/* _GMLfunc_directory_create(dname)
 * Wrapper for function: directory_create.
 * /
function _GMLfunc_directory_create(dname) {
	return directory_create(dname);
}
//*/

/* _GMLfunc_file_find_first(mask,attr)
 * Wrapper for function: file_find_first.
 * /
function _GMLfunc_file_find_first(mask, attr) {
	return file_find_first(mask, attr);
}
//*/

/* _GMLfunc_file_find_next()
 * Wrapper for function: file_find_next.
 * /
function _GMLfunc_file_find_next() {
	return file_find_next();
}
//*/

/* _GMLfunc_file_find_close()
 * Wrapper for function: file_find_close.
 * /
function _GMLfunc_file_find_close() {
	return file_find_close();
}
//*/

/* _GMLfunc_file_attributes(fname,attr)
 * Wrapper for function: file_attributes.
 * /
function _GMLfunc_file_attributes(fname, attr) {
	return file_attributes(fname, attr);
}
//*/

/* _GMLfunc_filename_name(fname)
 * Wrapper for function: filename_name.
 * /
function _GMLfunc_filename_name(fname) {
	return filename_name(fname);
}
//*/

/* _GMLfunc_filename_path(fname)
 * Wrapper for function: filename_path.
 * /
function _GMLfunc_filename_path(fname) {
	return filename_path(fname);
}
//*/

/* _GMLfunc_filename_dir(fname)
 * Wrapper for function: filename_dir.
 * /
function _GMLfunc_filename_dir(fname) {
	return filename_dir(fname);
}
//*/

/* _GMLfunc_filename_drive(fname)
 * Wrapper for function: filename_drive.
 * /
function _GMLfunc_filename_drive(fname) {
	return filename_drive(fname);
}
//*/

/* _GMLfunc_filename_ext(fname)
 * Wrapper for function: filename_ext.
 * /
function _GMLfunc_filename_ext(fname) {
	return filename_ext(fname);
}
//*/

/* _GMLfunc_filename_change_ext(fname,newext)
 * Wrapper for function: filename_change_ext.
 * /
function _GMLfunc_filename_change_ext(fname, newext) {
	return filename_change_ext(fname, newext);
}
//*/

/* _GMLfunc_file_bin_open(fname,mode)
 * Wrapper for function: file_bin_open.
 * /
function _GMLfunc_file_bin_open(fname, mode) {
	return file_bin_open(fname, mode);
}
//*/

/* _GMLfunc_file_bin_rewrite(file)
 * Wrapper for function: file_bin_rewrite.
 * /
function _GMLfunc_file_bin_rewrite(file) {
	return file_bin_rewrite(file);
}
//*/

/* _GMLfunc_file_bin_close(file)
 * Wrapper for function: file_bin_close.
 * /
function _GMLfunc_file_bin_close(file) {
	return file_bin_close(file);
}
//*/

/* _GMLfunc_file_bin_position(file)
 * Wrapper for function: file_bin_position.
 * /
function _GMLfunc_file_bin_position(file) {
	return file_bin_position(file);
}
//*/

/* _GMLfunc_file_bin_size(file)
 * Wrapper for function: file_bin_size.
 * /
function _GMLfunc_file_bin_size(file) {
	return file_bin_size(file);
}
//*/

/* _GMLfunc_file_bin_seek(file,pos)
 * Wrapper for function: file_bin_seek.
 * /
function _GMLfunc_file_bin_seek(file, pos) {
	return file_bin_seek(file, pos);
}
//*/

/* _GMLfunc_file_bin_write_byte(file,byte)
 * Wrapper for function: file_bin_write_byte.
 * /
function _GMLfunc_file_bin_write_byte(file, byte) {
	return file_bin_write_byte(file, byte);
}
//*/

/* _GMLfunc_file_bin_read_byte(file)
 * Wrapper for function: file_bin_read_byte.
 * /
function _GMLfunc_file_bin_read_byte(file) {
	return file_bin_read_byte(file);
}
//*/

/* _GMLfunc_export_include_file(fname)
 * Wrapper for function: export_include_file.
 * /
function _GMLfunc_export_include_file(fname) {
	return export_include_file(fname);
}
//*/

/* _GMLfunc_export_include_file_location(fname,location)
 * Wrapper for function: export_include_file_location.
 * /
function _GMLfunc_export_include_file_location(fname, location) {
	return export_include_file_location(fname, location);
}
//*/

/* _GMLfunc_discard_include_file(fname)
 * Wrapper for function: discard_include_file.
 * /
function _GMLfunc_discard_include_file(fname) {
	return discard_include_file(fname);
}
//*/

/* _GMLfunc_parameter_count()
 * Wrapper for function: parameter_count.
 * /
function _GMLfunc_parameter_count() {
	return parameter_count();
}
//*/

/* _GMLfunc_parameter_string(n)
 * Wrapper for function: parameter_string.
 * /
function _GMLfunc_parameter_string(n) {
	return parameter_string(n);

	 # define _GMLfunc_environment_get_ /* _GMLfunc_environment_get_ * Wrapper for return environment_get_
	function _GMLfunc_disk_free(drive) {}
	//*/

	/* _GMLfunc_disk_free(drive)
	function: environment_get_ */
	 * Wrapper for  *  /
	return disk_free(drive);

	function  : disk_free.
}
//*/

/* _GMLfunc_disk_size(drive)
 * Wrapper for function: disk_size.
 * /
function _GMLfunc_disk_size(drive) {
	return disk_size(drive);
}
//*/

/* _GMLfunc_registry_write_string(name,str)
 * Wrapper for function: registry_write_string.
 * /
function _GMLfunc_registry_write_string(name, str) {
	return registry_write_string(name, str);
}
//*/

/* _GMLfunc_registry_write_real(name,value)
 * Wrapper for function: registry_write_real.
 * /
function _GMLfunc_registry_write_real(name, value) {
	return registry_write_real(name, value);
}
//*/

/* _GMLfunc_registry_read_string(name)
 * Wrapper for function: registry_read_string.
 * /
function _GMLfunc_registry_read_string(name) {
	return registry_read_string(name);
}
//*/

/* _GMLfunc_registry_read_real(name)
 * Wrapper for function: registry_read_real.
 * /
function _GMLfunc_registry_read_real(name) {
	return registry_read_real(name);
}
//*/

/* _GMLfunc_registry_exists(name)
 * Wrapper for function: registry_exists.
 * /
function _GMLfunc_registry_exists(name) {
	return registry_exists(name);
}
//*/

/* _GMLfunc_registry_write_string_ext(key,name,str)
 * Wrapper for function: registry_write_string_ext.
 * /
function _GMLfunc_registry_write_string_ext(key, name, str) {
	return registry_write_string_ext(key, name, str);
}
//*/

/* _GMLfunc_registry_write_real_ext(key,name,value)
 * Wrapper for function: registry_write_real_ext.
 * /
function _GMLfunc_registry_write_real_ext(key, name, value) {
	return registry_write_real_ext(key, name, value);
}
//*/

/* _GMLfunc_registry_read_string_ext(key,name)
 * Wrapper for function: registry_read_string_ext.
 * /
function _GMLfunc_registry_read_string_ext(key, name) {
	return registry_read_string_ext(key, name);
}
//*/

/* _GMLfunc_registry_read_real_ext(key,name)
 * Wrapper for function: registry_read_real_ext.
 * /
function _GMLfunc_registry_read_real_ext(key, name) {
	return registry_read_real_ext(key, name);
}
//*/

/* _GMLfunc_registry_exists_ext(key,name)
 * Wrapper for function: registry_exists_ext.
 * /
function _GMLfunc_registry_exists_ext(key, name) {
	return registry_exists_ext(key, name);
}
//*/

/* _GMLfunc_registry_set_root(root)
 * Wrapper for function: registry_set_root.
 * /
function _GMLfunc_registry_set_root(root) {
	return registry_set_root(root);
}
//*/

/* _GMLfunc_ini_open(fname)
 * Wrapper for function: ini_open.
 * /
function _GMLfunc_ini_open(fname) {
	return ini_open(fname);
}
//*/

/* _GMLfunc_ini_close()
 * Wrapper for function: ini_close.
 * /
function _GMLfunc_ini_close() {
	return ini_close();
}
//*/

/* _GMLfunc_ini_read_string(section,key,def)
 * Wrapper for function: ini_read_string.
 * /
function _GMLfunc_ini_read_string(section, key, def) {
	return ini_read_string(section, key, def);
}
//*/

/* _GMLfunc_ini_read_real(section,key,def)
 * Wrapper for function: ini_read_real.
 * /
function _GMLfunc_ini_read_real(section, key, def) {
	return ini_read_real(section, key, def);
}
//*/

/* _GMLfunc_ini_write_string(section,key,str)
 * Wrapper for function: ini_write_string.
 * /
function _GMLfunc_ini_write_string(section, key, str) {
	return ini_write_string(section, key, str);
}
//*/

/* _GMLfunc_ini_write_real(section,key,value)
 * Wrapper for function: ini_write_real.
 * /
function _GMLfunc_ini_write_real(section, key, value) {
	return ini_write_real(section, key, value);
}
//*/

/* _GMLfunc_ini_key_exists(section,key)
 * Wrapper for function: ini_key_exists.
 * /
function _GMLfunc_ini_key_exists(section, key) {
	return ini_key_exists(section, key);
}
//*/

/* _GMLfunc_ini_section_exists(section)
 * Wrapper for function: ini_section_exists.
 * /
function _GMLfunc_ini_section_exists(section) {
	return ini_section_exists(section);
}
//*/

/* _GMLfunc_ini_key_delete(section,key)
 * Wrapper for function: ini_key_delete.
 * /
function _GMLfunc_ini_key_delete(section, key) {
	return ini_key_delete(section, key);
}
//*/

/* _GMLfunc_ini_section_delete(section)
 * Wrapper for function: ini_section_delete.
 * /
function _GMLfunc_ini_section_delete(section) {
	return ini_section_delete(section);
}
//*/

/* _GMLfunc_execute_program(prog,arg,wait)
 * Wrapper for function: execute_program.
 * /
function _GMLfunc_execute_program(prog, arg, wait) {
	return execute_program(prog, arg, wait);
}
//*/

/* _GMLfunc_execute_shell(prog,arg)
 * Wrapper for function: execute_shell.
 * /
function _GMLfunc_execute_shell(prog, arg) {
	return execute_shell(prog, arg);
}
//*/

/* _GMLfunc_ds_set_precision(prec)
 * Wrapper for function: ds_set_precision.
 * /
function _GMLfunc_ds_set_precision(prec) {
	return ds_set_precision(prec);
}
//*/

/* _GMLfunc_ds_stack_create()
 * Wrapper for function: ds_stack_create.
 * /
function _GMLfunc_ds_stack_create() {
	return ds_stack_create();
}
//*/

/* _GMLfunc_ds_stack_destroy(_id)
 * Wrapper for function: ds_stack_destroy.
 * /
function _GMLfunc_ds_stack_destroy(_id) {
	return ds_stack_destroy(_id);
}
//*/

/* _GMLfunc_ds_stack_clear(_id)
 * Wrapper for function: ds_stack_clear.
 * /
function _GMLfunc_ds_stack_clear(_id) {
	return ds_stack_clear(_id);
}
//*/

/* _GMLfunc_ds_stack_copy(_id,source)
 * Wrapper for function: ds_stack_copy.
 * /
function _GMLfunc_ds_stack_copy(_id, source) {
	return ds_stack_copy(_id, source);
}
//*/

/* _GMLfunc_ds_stack_size(_id)
 * Wrapper for function: ds_stack_size.
 * /
function _GMLfunc_ds_stack_size(_id) {
	return ds_stack_size(_id);
}
//*/

/* _GMLfunc_ds_stack_empty(_id)
 * Wrapper for function: ds_stack_empty.
 * /
function _GMLfunc_ds_stack_empty(_id) {
	return ds_stack_empty(_id);
}
//*/

/* _GMLfunc_ds_stack_push(_id,value)
 * Wrapper for function: ds_stack_push.
 * /
function _GMLfunc_ds_stack_push(_id, value) {
	return ds_stack_push(_id, value);
}
//*/

/* _GMLfunc_ds_stack_pop(_id)
 * Wrapper for function: ds_stack_pop.
 * /
function _GMLfunc_ds_stack_pop(_id) {
	return ds_stack_pop(_id);
}
//*/

/* _GMLfunc_ds_stack_top(_id)
 * Wrapper for function: ds_stack_top.
 * /
function _GMLfunc_ds_stack_top(_id) {
	return ds_stack_top(_id);
}
//*/

/* _GMLfunc_ds_stack_write(_id)
 * Wrapper for function: ds_stack_write.
 * /
function _GMLfunc_ds_stack_write(_id) {
	return ds_stack_write(_id);
}
//*/

/* _GMLfunc_ds_stack_read(_id,str)
 * Wrapper for function: ds_stack_read.
 * /
function _GMLfunc_ds_stack_read(_id, str) {
	return ds_stack_read(_id, str);
}
//*/

/* _GMLfunc_ds_queue_create()
 * Wrapper for function: ds_queue_create.
 * /
function _GMLfunc_ds_queue_create() {
	return ds_queue_create();
}
//*/

/* _GMLfunc_ds_queue_destroy(_id)
 * Wrapper for function: ds_queue_destroy.
 * /
function _GMLfunc_ds_queue_destroy(_id) {
	return ds_queue_destroy(_id);
}
//*/

/* _GMLfunc_ds_queue_clear(_id)
 * Wrapper for function: ds_queue_clear.
 * /
function _GMLfunc_ds_queue_clear(_id) {
	return ds_queue_clear(_id);
}
//*/

/* _GMLfunc_ds_queue_copy(_id,source)
 * Wrapper for function: ds_queue_copy.
 * /
function _GMLfunc_ds_queue_copy(_id, source) {
	return ds_queue_copy(_id, source);
}
//*/

/* _GMLfunc_ds_queue_size(_id)
 * Wrapper for function: ds_queue_size.
 * /
function _GMLfunc_ds_queue_size(_id) {
	return ds_queue_size(_id);
}
//*/

/* _GMLfunc_ds_queue_empty(_id)
 * Wrapper for function: ds_queue_empty.
 * /
function _GMLfunc_ds_queue_empty(_id) {
	return ds_queue_empty(_id);
}
//*/

/* _GMLfunc_ds_queue_enqueue(_id,value)
 * Wrapper for function: ds_queue_enqueue.
 * /
function _GMLfunc_ds_queue_enqueue(_id, value) {
	return ds_queue_enqueue(_id, value);
}
//*/

/* _GMLfunc_ds_queue_dequeue(_id)
 * Wrapper for function: ds_queue_dequeue.
 * /
function _GMLfunc_ds_queue_dequeue(_id) {
	return ds_queue_dequeue(_id);
}
//*/

/* _GMLfunc_ds_queue_head(_id)
 * Wrapper for function: ds_queue_head.
 * /
function _GMLfunc_ds_queue_head(_id) {
	return ds_queue_head(_id);
}
//*/

/* _GMLfunc_ds_queue_tail(_id)
 * Wrapper for function: ds_queue_tail.
 * /
function _GMLfunc_ds_queue_tail(_id) {
	return ds_queue_tail(_id);
}
//*/

/* _GMLfunc_ds_queue_write(_id)
 * Wrapper for function: ds_queue_write.
 * /
function _GMLfunc_ds_queue_write(_id) {
	return ds_queue_write(_id);
}
//*/

/* _GMLfunc_ds_queue_read(_id,str)
 * Wrapper for function: ds_queue_read.
 * /
function _GMLfunc_ds_queue_read(_id, str) {
	return ds_queue_read(_id, str);
}
//*/

/* _GMLfunc_ds_list_create()
 * Wrapper for function: ds_list_create.
 * /
function _GMLfunc_ds_list_create() {
	return ds_list_create();
}
//*/

/* _GMLfunc_ds_list_destroy(_id)
 * Wrapper for function: ds_list_destroy.
 * /
function _GMLfunc_ds_list_destroy(_id) {
	return ds_list_destroy(_id);
}
//*/

/* _GMLfunc_ds_list_clear(_id)
 * Wrapper for function: ds_list_clear.
 * /
function _GMLfunc_ds_list_clear(_id) {
	return ds_list_clear(_id);
}
//*/

/* _GMLfunc_ds_list_copy(_id,source)
 * Wrapper for function: ds_list_copy.
 * /
function _GMLfunc_ds_list_copy(_id, source) {
	return ds_list_copy(_id, source);
}
//*/

/* _GMLfunc_ds_list_size(_id)
 * Wrapper for function: ds_list_size.
 * /
function _GMLfunc_ds_list_size(_id) {
	return ds_list_size(_id);
}
//*/

/* _GMLfunc_ds_list_empty(_id)
 * Wrapper for function: ds_list_empty.
 * /
function _GMLfunc_ds_list_empty(_id) {
	return ds_list_empty(_id);
}
//*/

/* _GMLfunc_ds_list_add(_id,value)
 * Wrapper for function: ds_list_add.
 * /
function _GMLfunc_ds_list_add(_id, value) {
	return ds_list_add(_id, value);
}
//*/

/* _GMLfunc_ds_list_insert(_id,pos,value)
 * Wrapper for function: ds_list_insert.
 * /
function _GMLfunc_ds_list_insert(_id, pos, value) {
	return ds_list_insert(_id, pos, value);
}
//*/

/* _GMLfunc_ds_list_replace(_id,pos,value)
 * Wrapper for function: ds_list_replace.
 * /
function _GMLfunc_ds_list_replace(_id, pos, value) {
	return ds_list_replace(_id, pos, value);
}
//*/

/* _GMLfunc_ds_list_delete(_id,pos)
 * Wrapper for function: ds_list_delete.
 * /
function _GMLfunc_ds_list_delete(_id, pos) {
	return ds_list_delete(_id, pos);
}
//*/

/* _GMLfunc_ds_list_find_index(_id,value)
 * Wrapper for function: ds_list_find_index.
 * /
function _GMLfunc_ds_list_find_index(_id, value) {
	return ds_list_find_index(_id, value);
}
//*/

/* _GMLfunc_ds_list_find_value(_id,pos)
 * Wrapper for function: ds_list_find_value.
 * /
function _GMLfunc_ds_list_find_value(_id, pos) {
	return ds_list_find_value(_id, pos);
}
//*/

/* _GMLfunc_ds_list_sort(_id,ascending)
 * Wrapper for function: ds_list_sort.
 * /
function _GMLfunc_ds_list_sort(_id, ascending) {
	return ds_list_sort(_id, ascending);
}
//*/

/* _GMLfunc_ds_list_shuffle(_id)
 * Wrapper for function: ds_list_shuffle.
 * /
function _GMLfunc_ds_list_shuffle(_id) {
	return ds_list_shuffle(_id);
}
//*/

/* _GMLfunc_ds_list_write(_id)
 * Wrapper for function: ds_list_write.
 * /
function _GMLfunc_ds_list_write(_id) {
	return ds_list_write(_id);
}
//*/

/* _GMLfunc_ds_list_read(_id,str)
 * Wrapper for function: ds_list_read.
 * /
function _GMLfunc_ds_list_read(_id, str) {
	return ds_list_read(_id, str);
}
//*/

/* _GMLfunc_ds_map_create()
 * Wrapper for function: ds_map_create.
 * /
function _GMLfunc_ds_map_create() {
	return ds_map_create();
}
//*/

/* _GMLfunc_ds_map_destroy(_id)
 * Wrapper for function: ds_map_destroy.
 * /
function _GMLfunc_ds_map_destroy(_id) {
	return ds_map_destroy(_id);
}
//*/

/* _GMLfunc_ds_map_clear(_id)
 * Wrapper for function: ds_map_clear.
 * /
function _GMLfunc_ds_map_clear(_id) {
	return ds_map_clear(_id);
}
//*/

/* _GMLfunc_ds_map_copy(_id,source)
 * Wrapper for function: ds_map_copy.
 * /
function _GMLfunc_ds_map_copy(_id, source) {
	return ds_map_copy(_id, source);
}
//*/

/* _GMLfunc_ds_map_size(_id)
 * Wrapper for function: ds_map_size.
 * /
function _GMLfunc_ds_map_size(_id) {
	return ds_map_size(_id);
}
//*/

/* _GMLfunc_ds_map_empty(_id)
 * Wrapper for function: ds_map_empty.
 * /
function _GMLfunc_ds_map_empty(_id) {
	return ds_map_empty(_id);
}
//*/

/* _GMLfunc_ds_map_add(_id,key,value)
 * Wrapper for function: ds_map_add.
 * /
function _GMLfunc_ds_map_add(_id, key, value) {
	return ds_map_add(_id, key, value);
}
//*/

/* _GMLfunc_ds_map_replace(_id,key,value)
 * Wrapper for function: ds_map_replace.
 * /
function _GMLfunc_ds_map_replace(_id, key, value) {
	return ds_map_replace(_id, key, value);
}
//*/

/* _GMLfunc_ds_map_delete(_id,key)
 * Wrapper for function: ds_map_delete.
 * /
function _GMLfunc_ds_map_delete(_id, key) {
	return ds_map_delete(_id, key);
}
//*/

/* _GMLfunc_ds_map_exists(_id,key)
 * Wrapper for function: ds_map_exists.
 * /
function _GMLfunc_ds_map_exists(_id, key) {
	return ds_map_exists(_id, key);
}
//*/

/* _GMLfunc_ds_map_find_value(_id,key)
 * Wrapper for function: ds_map_find_value.
 * /
function _GMLfunc_ds_map_find_value(_id, key) {
	return ds_map_find_value(_id, key);
}
//*/

/* _GMLfunc_ds_map_find_previous(_id,key)
 * Wrapper for function: ds_map_find_previous.
 * /
function _GMLfunc_ds_map_find_previous(_id, key) {
	return ds_map_find_previous(_id, key);
}
//*/

/* _GMLfunc_ds_map_find_next(_id,key)
 * Wrapper for function: ds_map_find_next.
 * /
function _GMLfunc_ds_map_find_next(_id, key) {
	return ds_map_find_next(_id, key);
}
//*/

/* _GMLfunc_ds_map_find_first(_id)
 * Wrapper for function: ds_map_find_first.
 * /
function _GMLfunc_ds_map_find_first(_id) {
	return ds_map_find_first(_id);
}
//*/

/* _GMLfunc_ds_map_find_last(_id)
 * Wrapper for function: ds_map_find_last.
 * /
function _GMLfunc_ds_map_find_last(_id) {
	return ds_map_find_last(_id);
}
//*/

/* _GMLfunc_ds_map_write(_id)
 * Wrapper for function: ds_map_write.
 * /
function _GMLfunc_ds_map_write(_id) {
	return ds_map_write(_id);
}
//*/

/* _GMLfunc_ds_map_read(_id,str)
 * Wrapper for function: ds_map_read.
 * /
function _GMLfunc_ds_map_read(_id, str) {
	return ds_map_read(_id, str);
}
//*/

/* _GMLfunc_ds_priority_create()
 * Wrapper for function: ds_priority_create.
 * /
function _GMLfunc_ds_priority_create() {
	return ds_priority_create();
}
//*/

/* _GMLfunc_ds_priority_destroy(_id)
 * Wrapper for function: ds_priority_destroy.
 * /
function _GMLfunc_ds_priority_destroy(_id) {
	return ds_priority_destroy(_id);
}
//*/

/* _GMLfunc_ds_priority_clear(_id)
 * Wrapper for function: ds_priority_clear.
 * /
function _GMLfunc_ds_priority_clear(_id) {
	return ds_priority_clear(_id);
}
//*/

/* _GMLfunc_ds_priority_copy(_id,source)
 * Wrapper for function: ds_priority_copy.
 * /
function _GMLfunc_ds_priority_copy(_id, source) {
	return ds_priority_copy(_id, source);
}
//*/

/* _GMLfunc_ds_priority_size(_id)
 * Wrapper for function: ds_priority_size.
 * /
function _GMLfunc_ds_priority_size(_id) {
	return ds_priority_size(_id);
}
//*/

/* _GMLfunc_ds_priority_empty(_id)
 * Wrapper for function: ds_priority_empty.
 * /
function _GMLfunc_ds_priority_empty(_id) {
	return ds_priority_empty(_id);
}
//*/

/* _GMLfunc_ds_priority_add(_id,value,priority)
 * Wrapper for function: ds_priority_add.
 * /
function _GMLfunc_ds_priority_add(_id, value, priority) {
	return ds_priority_add(_id, value, priority);
}
//*/

/* _GMLfunc_ds_priority_change_priority(_id,value,priority)
 * Wrapper for function: ds_priority_change_priority.
 * /
function _GMLfunc_ds_priority_change_priority(_id, value, priority) {
	return ds_priority_change_priority(_id, value, priority);
}
//*/

/* _GMLfunc_ds_priority_find_priority(_id,value)
 * Wrapper for function: ds_priority_find_priority.
 * /
function _GMLfunc_ds_priority_find_priority(_id, value) {
	return ds_priority_find_priority(_id, value);
}
//*/

/* _GMLfunc_ds_priority_delete_value(_id,value)
 * Wrapper for function: ds_priority_delete_value.
 * /
function _GMLfunc_ds_priority_delete_value(_id, value) {
	return ds_priority_delete_value(_id, value);
}
//*/

/* _GMLfunc_ds_priority_delete_min(_id)
 * Wrapper for function: ds_priority_delete_min.
 * /
function _GMLfunc_ds_priority_delete_min(_id) {
	return ds_priority_delete_min(_id);
}
//*/

/* _GMLfunc_ds_priority_find_min(_id)
 * Wrapper for function: ds_priority_find_min.
 * /
function _GMLfunc_ds_priority_find_min(_id) {
	return ds_priority_find_min(_id);
}
//*/

/* _GMLfunc_ds_priority_delete_max(_id)
 * Wrapper for function: ds_priority_delete_max.
 * /
function _GMLfunc_ds_priority_delete_max(_id) {
	return ds_priority_delete_max(_id);
}
//*/

/* _GMLfunc_ds_priority_find_max(_id)
 * Wrapper for function: ds_priority_find_max.
 * /
function _GMLfunc_ds_priority_find_max(_id) {
	return ds_priority_find_max(_id);
}
//*/

/* _GMLfunc_ds_priority_write(_id)
 * Wrapper for function: ds_priority_write.
 * /
function _GMLfunc_ds_priority_write(_id) {
	return ds_priority_write(_id);
}
//*/

/* _GMLfunc_ds_priority_read(_id,str)
 * Wrapper for function: ds_priority_read.
 * /
function _GMLfunc_ds_priority_read(_id, str) {
	return ds_priority_read(_id, str);
}
//*/

/* _GMLfunc_ds_grid_create(w,h)
 * Wrapper for function: ds_grid_create.
 * /
function _GMLfunc_ds_grid_create(w, h) {
	return ds_grid_create(w, h);
}
//*/

/* _GMLfunc_ds_grid_destroy(_id)
 * Wrapper for function: ds_grid_destroy.
 * /
function _GMLfunc_ds_grid_destroy(_id) {
	return ds_grid_destroy(_id);
}
//*/

/* _GMLfunc_ds_grid_copy(_id,source)
 * Wrapper for function: ds_grid_copy.
 * /
function _GMLfunc_ds_grid_copy(_id, source) {
	return ds_grid_copy(_id, source);
}
//*/

/* _GMLfunc_ds_grid_resize(_id,w,h)
 * Wrapper for function: ds_grid_resize.
 * /
function _GMLfunc_ds_grid_resize(_id, w, h) {
	return ds_grid_resize(_id, w, h);
}
//*/

/* _GMLfunc_ds_grid_width(_id)
 * Wrapper for function: ds_grid_width.
 * /
function _GMLfunc_ds_grid_width(_id) {
	return ds_grid_width(_id);
}
//*/

/* _GMLfunc_ds_grid_height(_id)
 * Wrapper for function: ds_grid_height.
 * /
function _GMLfunc_ds_grid_height(_id) {
	return ds_grid_height(_id);
}
//*/

/* _GMLfunc_ds_grid_clear(_id,val)
 * Wrapper for function: ds_grid_clear.
 * /
function _GMLfunc_ds_grid_clear(_id, val) {
	return ds_grid_clear(_id, val);
}
//*/

/* _GMLfunc_ds_grid_set(_id,xx,yy,val)
 * Wrapper for function: ds_grid_set.
 * /
function _GMLfunc_ds_grid_set(_id, xx, yy, val) {
	return ds_grid_set(_id, xx, yy, val);
}
//*/

/* _GMLfunc_ds_grid_add(_id,xx,yy,val)
 * Wrapper for function: ds_grid_add.
 * /
function _GMLfunc_ds_grid_add(_id, xx, yy, val) {
	return ds_grid_add(_id, xx, yy, val);
}
//*/

/* _GMLfunc_ds_grid_multiply(_id,xx,yy,val)
 * Wrapper for function: ds_grid_multiply.
 * /
function _GMLfunc_ds_grid_multiply(_id, xx, yy, val) {
	return ds_grid_multiply(_id, xx, yy, val);
}
//*/

/* _GMLfunc_ds_grid_set_region(_id,x1,y1,x2,y2,val)
 * Wrapper for function: ds_grid_set_region.
 * /
function _GMLfunc_ds_grid_set_region(_id, x1, y1, x2, y2, val) {
	return ds_grid_set_region(_id, x1, y1, x2, y2, val);
}
//*/

/* _GMLfunc_ds_grid_add_region(_id,x1,y1,x2,y2,val)
 * Wrapper for function: ds_grid_add_region.
 * /
function _GMLfunc_ds_grid_add_region(_id, x1, y1, x2, y2, val) {
	return ds_grid_add_region(_id, x1, y1, x2, y2, val);
}
//*/

/* _GMLfunc_ds_grid_multiply_region(_id,x1,y1,x2,y2,val)
 * Wrapper for function: ds_grid_multiply_region.
 * /
function _GMLfunc_ds_grid_multiply_region(_id, x1, y1, x2, y2, val) {
	return ds_grid_multiply_region(_id, x1, y1, x2, y2, val);
}
//*/

/* _GMLfunc_ds_grid_set_disk(_id,xm,ym,r,val)
 * Wrapper for function: ds_grid_set_disk.
 * /
function _GMLfunc_ds_grid_set_disk(_id, xm, ym, r, val) {
	return ds_grid_set_disk(_id, xm, ym, r, val);
}
//*/

/* _GMLfunc_ds_grid_add_disk(_id,xm,ym,r,val)
 * Wrapper for function: ds_grid_add_disk.
 * /
function _GMLfunc_ds_grid_add_disk(_id, xm, ym, r, val) {
	return ds_grid_add_disk(_id, xm, ym, r, val);
}
//*/

/* _GMLfunc_ds_grid_multiply_disk(_id,xm,ym,r,val)
 * Wrapper for function: ds_grid_multiply_disk.
 * /
function _GMLfunc_ds_grid_multiply_disk(_id, xm, ym, r, val) {
	return ds_grid_multiply_disk(_id, xm, ym, r, val);
}
//*/

/* _GMLfunc_ds_grid_set_grid_region(_id,source,x1,y1,x2,y2,xpos,ypos)
 * Wrapper for function: ds_grid_set_grid_region.
 * /
function _GMLfunc_ds_grid_set_grid_region(_id, source, x1, y1, x2, y2, xpos, ypos) {
	return ds_grid_set_grid_region(_id, source, x1, y1, x2, y2, xpos, ypos);
}
//*/

/* _GMLfunc_ds_grid_add_grid_region(_id,source,x1,y1,x2,y2,xpos,ypos)
 * Wrapper for function: ds_grid_add_grid_region.
 * /
function _GMLfunc_ds_grid_add_grid_region(_id, source, x1, y1, x2, y2, xpos, ypos) {
	return ds_grid_add_grid_region(_id, source, x1, y1, x2, y2, xpos, ypos);
}
//*/

/* _GMLfunc_ds_grid_multiply_grid_region(_id,source,x1,y1,x2,y2,xpos,ypos)
 * Wrapper for function: ds_grid_multiply_grid_region.
 * /
function _GMLfunc_ds_grid_multiply_grid_region(_id, source, x1, y1, x2, y2, xpos, ypos) {
	return ds_grid_multiply_grid_region(_id, source, x1, y1, x2, y2, xpos, ypos);
}
//*/

/* _GMLfunc_ds_grid_get(_id,xx,yy)
 * Wrapper for function: ds_grid_get.
 * /
function _GMLfunc_ds_grid_get(_id, xx, yy) {
	return ds_grid_get(_id, xx, yy);
}
//*/

/* _GMLfunc_ds_grid_get_sum(_id,x1,y1,x2,y2)
 * Wrapper for function: ds_grid_get_sum.
 * /
function _GMLfunc_ds_grid_get_sum(_id, x1, y1, x2, y2) {
	return ds_grid_get_sum(_id, x1, y1, x2, y2);
}
//*/

/* _GMLfunc_ds_grid_get_max(_id,x1,y1,x2,y2)
 * Wrapper for function: ds_grid_get_max.
 * /
function _GMLfunc_ds_grid_get_max(_id, x1, y1, x2, y2) {
	return ds_grid_get_max(_id, x1, y1, x2, y2);
}
//*/

/* _GMLfunc_ds_grid_get_min(_id,x1,y1,x2,y2)
 * Wrapper for function: ds_grid_get_min.
 * /
function _GMLfunc_ds_grid_get_min(_id, x1, y1, x2, y2) {
	return ds_grid_get_min(_id, x1, y1, x2, y2);
}
//*/

/* _GMLfunc_ds_grid_get_mean(_id,x1,y1,x2,y2)
 * Wrapper for function: ds_grid_get_mean.
 * /
function _GMLfunc_ds_grid_get_mean(_id, x1, y1, x2, y2) {
	return ds_grid_get_mean(_id, x1, y1, x2, y2);
}
//*/

/* _GMLfunc_ds_grid_get_disk_sum(_id,xm,ym,r)
 * Wrapper for function: ds_grid_get_disk_sum.
 * /
function _GMLfunc_ds_grid_get_disk_sum(_id, xm, ym, r) {
	return ds_grid_get_disk_sum(_id, xm, ym, r);
}
//*/

/* _GMLfunc_ds_grid_get_disk_min(_id,xm,ym,r)
 * Wrapper for function: ds_grid_get_disk_min.
 * /
function _GMLfunc_ds_grid_get_disk_min(_id, xm, ym, r) {
	return ds_grid_get_disk_min(_id, xm, ym, r);
}
//*/

/* _GMLfunc_ds_grid_get_disk_max(_id,xm,ym,r)
 * Wrapper for function: ds_grid_get_disk_max.
 * /
function _GMLfunc_ds_grid_get_disk_max(_id, xm, ym, r) {
	return ds_grid_get_disk_max(_id, xm, ym, r);
}
//*/

/* _GMLfunc_ds_grid_get_disk_mean(_id,xm,ym,r)
 * Wrapper for function: ds_grid_get_disk_mean.
 * /
function _GMLfunc_ds_grid_get_disk_mean(_id, xm, ym, r) {
	return ds_grid_get_disk_mean(_id, xm, ym, r);
}
//*/

/* _GMLfunc_ds_grid_value_exists(_id,x1,y1,x2,y2,val)
 * Wrapper for function: ds_grid_value_exists.
 * /
function _GMLfunc_ds_grid_value_exists(_id, x1, y1, x2, y2, val) {
	return ds_grid_value_exists(_id, x1, y1, x2, y2, val);
}
//*/

/* _GMLfunc_ds_grid_value_x(_id,x1,y1,x2,y2,val)
 * Wrapper for function: ds_grid_value_x.
 * /
function _GMLfunc_ds_grid_value_x(_id, x1, y1, x2, y2, val) {
	return ds_grid_value_x(_id, x1, y1, x2, y2, val);
}
//*/

/* _GMLfunc_ds_grid_value_y(_id,x1,y1,x2,y2,val)
 * Wrapper for function: ds_grid_value_y.
 * /
function _GMLfunc_ds_grid_value_y(_id, x1, y1, x2, y2, val) {
	return ds_grid_value_y(_id, x1, y1, x2, y2, val);
}
//*/

/* _GMLfunc_ds_grid_value_disk_exists(_id,xm,ym,r,val)
 * Wrapper for function: ds_grid_value_disk_exists.
 * /
function _GMLfunc_ds_grid_value_disk_exists(_id, xm, ym, r, val) {
	return ds_grid_value_disk_exists(_id, xm, ym, r, val);
}
//*/

/* _GMLfunc_ds_grid_value_disk_x(_id,xm,ym,r,val)
 * Wrapper for function: ds_grid_value_disk_x.
 * /
function _GMLfunc_ds_grid_value_disk_x(_id, xm, ym, r, val) {
	return ds_grid_value_disk_x(_id, xm, ym, r, val);
}
//*/

/* _GMLfunc_ds_grid_value_disk_y(_id,xm,ym,r,val)
 * Wrapper for function: ds_grid_value_disk_y.
 * /
function _GMLfunc_ds_grid_value_disk_y(_id, xm, ym, r, val) {
	return ds_grid_value_disk_y(_id, xm, ym, r, val);
}
//*/

/* _GMLfunc_ds_grid_shuffle(_id)
 * Wrapper for function: ds_grid_shuffle.
 * /
function _GMLfunc_ds_grid_shuffle(_id) {
	return ds_grid_shuffle(_id);
}
//*/

/* _GMLfunc_ds_grid_write(_id)
 * Wrapper for function: ds_grid_write.
 * /
function _GMLfunc_ds_grid_write(_id) {
	return ds_grid_write(_id);
}
//*/

/* _GMLfunc_ds_grid_read(_id,str)
 * Wrapper for function: ds_grid_read.
 * /
function _GMLfunc_ds_grid_read(_id, str) {
	return ds_grid_read(_id, str);
}
//*/

/* _GMLfunc_effect_create_below(kind,xx,yy,size,color)
 * Wrapper for function: effect_create_below.
 * /
function _GMLfunc_effect_create_below(kind, xx, yy, size, color) {
	return effect_create_below(kind, xx, yy, size, color);
}
//*/

/* _GMLfunc_effect_create_above(kind,xx,yy,size,color)
 * Wrapper for function: effect_create_above.
 * /
function _GMLfunc_effect_create_above(kind, xx, yy, size, color) {
	return effect_create_above(kind, xx, yy, size, color);
}
//*/

/* _GMLfunc_effect_clear()
 * Wrapper for function: effect_clear.
 * /
function _GMLfunc_effect_clear() {
	return effect_clear();
}
//*/

/* _GMLfunc_part_type_create()
 * Wrapper for function: part_type_create.
 * /
function _GMLfunc_part_type_create() {
	return part_type_create();
}
//*/

/* _GMLfunc_part_type_destroy(ind)
 * Wrapper for function: part_type_destroy.
 * /
function _GMLfunc_part_type_destroy(ind) {
	return part_type_destroy(ind);
}
//*/

/* _GMLfunc_part_type_exists(ind)
 * Wrapper for function: part_type_exists.
 * /
function _GMLfunc_part_type_exists(ind) {
	return part_type_exists(ind);
}
//*/

/* _GMLfunc_part_type_clear(ind)
 * Wrapper for function: part_type_clear.
 * /
function _GMLfunc_part_type_clear(ind) {
	return part_type_clear(ind);
}
//*/

/* _GMLfunc_part_type_shape(ind,shape)
 * Wrapper for function: part_type_shape.
 * /
function _GMLfunc_part_type_shape(ind, shape) {
	return part_type_shape(ind, shape);
}
//*/

/* _GMLfunc_part_type_sprite(ind,sprite,animat,stretch,random)
 * Wrapper for function: part_type_sprite.
 * /
function _GMLfunc_part_type_sprite(ind, sprite, animat, stretch, random) {
	return part_type_sprite(ind, sprite, animat, stretch, random);
}
//*/

/* _GMLfunc_part_type_size(ind,size_min,size_max,size_incr,size_wiggle)
 * Wrapper for function: part_type_size.
 * /
function _GMLfunc_part_type_size(ind, size_min, size_max, size_incr, size_wiggle) {
	return part_type_size(ind, size_min, size_max, size_incr, size_wiggle);
}
//*/

/* _GMLfunc_part_type_scale(ind,xscale,yscale)
 * Wrapper for function: part_type_scale.
 * /
function _GMLfunc_part_type_scale(ind, xscale, yscale) {
	return part_type_scale(ind, xscale, yscale);
}
//*/

/* _GMLfunc_part_type_orientation(ind,ang_min,ang_max,ang_incr,ang_wiggle,ang_relative)
 * Wrapper for function: part_type_orientation.
 * /
function _GMLfunc_part_type_orientation(ind, ang_min, ang_max, ang_incr, ang_wiggle, ang_relative) {
	return part_type_orientation(ind, ang_min, ang_max, ang_incr, ang_wiggle, ang_relative);
}
//*/

/* _GMLfunc_part_type_life(ind,life_min,life_max)
 * Wrapper for function: part_type_life.
 * /
function _GMLfunc_part_type_life(ind, life_min, life_max) {
	return part_type_life(ind, life_min, life_max);
}
//*/

/* _GMLfunc_part_type_step(ind,step_number,step_type)
 * Wrapper for function: part_type_step.
 * /
function _GMLfunc_part_type_step(ind, step_number, step_type) {
	return part_type_step(ind, step_number, step_type);
}
//*/

/* _GMLfunc_part_type_death(ind,death_number,death_type)
 * Wrapper for function: part_type_death.
 * /
function _GMLfunc_part_type_death(ind, death_number, death_type) {
	return part_type_death(ind, death_number, death_type);
}
//*/

/* _GMLfunc_part_type_speed(ind,speed_min,speed_max,speed_incr,speed_wiggle)
 * Wrapper for function: part_type_speed.
 * /
function _GMLfunc_part_type_speed(ind, speed_min, speed_max, speed_incr, speed_wiggle) {
	return part_type_speed(ind, speed_min, speed_max, speed_incr, speed_wiggle);
}
//*/

/* _GMLfunc_part_type_direction(ind,dir_min,dir_max,dir_incr,dir_wiggle)
 * Wrapper for function: part_type_direction.
 * /
function _GMLfunc_part_type_direction(ind, dir_min, dir_max, dir_incr, dir_wiggle) {
	return part_type_direction(ind, dir_min, dir_max, dir_incr, dir_wiggle);
}
//*/

/* _GMLfunc_part_type_gravity(ind,grav_amount,grav_dir)
 * Wrapper for function: part_type_gravity.
 * /
function _GMLfunc_part_type_gravity(ind, grav_amount, grav_dir) {
	return part_type_gravity(ind, grav_amount, grav_dir);
}
//*/

/* _GMLfunc_part_type_color1(ind,color1)
 * Wrapper for function: part_type_color1.
 * /
function _GMLfunc_part_type_color1(ind, color1) {
	return part_type_color1(ind, color1);
}
//*/

/* _GMLfunc_part_type_color2(ind,color1,color2)
 * Wrapper for function: part_type_color2.
 * /
function _GMLfunc_part_type_color2(ind, color1, color2) {
	return part_type_color2(ind, color1, color2);
}
//*/

/* _GMLfunc_part_type_color3(ind,color1,color2,color3)
 * Wrapper for function: part_type_color3.
 * /
function _GMLfunc_part_type_color3(ind, color1, color2, color3) {
	return part_type_color3(ind, color1, color2, color3);
}
//*/

/* _GMLfunc_part_type_color_mix(ind,color1,color2)
 * Wrapper for function: part_type_color_mix.
 * /
function _GMLfunc_part_type_color_mix(ind, color1, color2) {
	return part_type_color_mix(ind, color1, color2);
}
//*/

/* _GMLfunc_part_type_color_rgb(ind,rmin,rmax,gmin,gmax,bmin,bmax)
 * Wrapper for function: part_type_color_rgb.
 * /
function _GMLfunc_part_type_color_rgb(ind, rmin, rmax, gmin, gmax, bmin, bmax) {
	return part_type_color_rgb(ind, rmin, rmax, gmin, gmax, bmin, bmax);
}
//*/

/* _GMLfunc_part_type_color_hsv(ind,hmin,hmax,smin,smax,vmin,vmax)
 * Wrapper for function: part_type_color_hsv.
 * /
function _GMLfunc_part_type_color_hsv(ind, hmin, hmax, smin, smax, vmin, vmax) {
	return part_type_color_hsv(ind, hmin, hmax, smin, smax, vmin, vmax);
}
//*/

/* _GMLfunc_part_type_alpha1(ind,alpha1)
 * Wrapper for function: part_type_alpha1.
 * /
function _GMLfunc_part_type_alpha1(ind, alpha1) {
	return part_type_alpha1(ind, alpha1);
}
//*/

/* _GMLfunc_part_type_alpha2(ind,alpha1,alpha2)
 * Wrapper for function: part_type_alpha2.
 * /
function _GMLfunc_part_type_alpha2(ind, alpha1, alpha2) {
	return part_type_alpha2(ind, alpha1, alpha2);
}
//*/

/* _GMLfunc_part_type_alpha3(ind,alpha1,alpha2,alpha3)
 * Wrapper for function: part_type_alpha3.
 * /
function _GMLfunc_part_type_alpha3(ind, alpha1, alpha2, alpha3) {
	return part_type_alpha3(ind, alpha1, alpha2, alpha3);
}
//*/

/* _GMLfunc_part_type_blend(ind,additive)
 * Wrapper for function: part_type_blend.
 * /
function _GMLfunc_part_type_blend(ind, additive) {
	return part_type_blend(ind, additive);
}
//*/

/* _GMLfunc_part_system_create()
 * Wrapper for function: part_system_create.
 * /
function _GMLfunc_part_system_create() {
	return part_system_create();
}
//*/

/* _GMLfunc_part_system_destroy(ind)
 * Wrapper for function: part_system_destroy.
 * /
function _GMLfunc_part_system_destroy(ind) {
	return part_system_destroy(ind);
}
//*/

/* _GMLfunc_part_system_exists(ind)
 * Wrapper for function: part_system_exists.
 * /
function _GMLfunc_part_system_exists(ind) {
	return part_system_exists(ind);
}
//*/

/* _GMLfunc_part_system_clear(ind)
 * Wrapper for function: part_system_clear.
 * /
function _GMLfunc_part_system_clear(ind) {
	return part_system_clear(ind);
}
//*/

/* _GMLfunc_part_system_draw_order(ind,oldtonew)
 * Wrapper for function: part_system_draw_order.
 * /
function _GMLfunc_part_system_draw_order(ind, oldtonew) {
	return part_system_draw_order(ind, oldtonew);
}
//*/

/* _GMLfunc_part_system_depth(ind,_depth)
 * Wrapper for function: part_system_depth.
 * /
function _GMLfunc_part_system_depth(ind, _depth) {
	return part_system_depth(ind, _depth);
}
//*/

/* _GMLfunc_part_system_position(ind,xx,yy)
 * Wrapper for function: part_system_position.
 * /
function _GMLfunc_part_system_position(ind, xx, yy) {
	return part_system_position(ind, xx, yy);
}
//*/

/* _GMLfunc_part_system_automatic_update(ind,automatic)
 * Wrapper for function: part_system_automatic_update.
 * /
function _GMLfunc_part_system_automatic_update(ind, automatic) {
	return part_system_automatic_update(ind, automatic);
}
//*/

/* _GMLfunc_part_system_automatic_draw(ind,draw)
 * Wrapper for function: part_system_automatic_draw.
 * /
function _GMLfunc_part_system_automatic_draw(ind, draw) {
	return part_system_automatic_draw(ind, draw);
}
//*/

/* _GMLfunc_part_system_update(ind)
 * Wrapper for function: part_system_update.
 * /
function _GMLfunc_part_system_update(ind) {
	return part_system_update(ind);
}
//*/

/* _GMLfunc_part_system_drawit(ind)
 * Wrapper for function: part_system_drawit.
 * /
function _GMLfunc_part_system_drawit(ind) {
	return part_system_drawit(ind);
}
//*/

/* _GMLfunc_part_particles_create(ind,xx,yy,parttype,number)
 * Wrapper for function: part_particles_create.
 * /
function _GMLfunc_part_particles_create(ind, xx, yy, parttype, number) {
	return part_particles_create(ind, xx, yy, parttype, number);
}
//*/

/* _GMLfunc_part_particles_create_color(ind,xx,yy,parttype,color,number)
 * Wrapper for function: part_particles_create_color.
 * /
function _GMLfunc_part_particles_create_color(ind, xx, yy, parttype, color, number) {
	return part_particles_create_color(ind, xx, yy, parttype, color, number);
}
//*/

/* _GMLfunc_part_particles_clear(ind)
 * Wrapper for function: part_particles_clear.
 * /
function _GMLfunc_part_particles_clear(ind) {
	return part_particles_clear(ind);
}
//*/

/* _GMLfunc_part_particles_count(ind)
 * Wrapper for function: part_particles_count.
 * /
function _GMLfunc_part_particles_count(ind) {
	return part_particles_count(ind);
}
//*/

/* _GMLfunc_part_emitter_create(ps)
 * Wrapper for function: part_emitter_create.
 * /
function _GMLfunc_part_emitter_create(ps) {
	return part_emitter_create(ps);
}
//*/

/* _GMLfunc_part_emitter_destroy(ps,ind)
 * Wrapper for function: part_emitter_destroy.
 * /
function _GMLfunc_part_emitter_destroy(ps, ind) {
	return part_emitter_destroy(ps, ind);
}
//*/

/* _GMLfunc_part_emitter_destroy_all(ps)
 * Wrapper for function: part_emitter_destroy_all.
 * /
function _GMLfunc_part_emitter_destroy_all(ps) {
	return part_emitter_destroy_all(ps);
}
//*/

/* _GMLfunc_part_emitter_exists(ps,ind)
 * Wrapper for function: part_emitter_exists.
 * /
function _GMLfunc_part_emitter_exists(ps, ind) {
	return part_emitter_exists(ps, ind);
}
//*/

/* _GMLfunc_part_emitter_clear(ps,ind)
 * Wrapper for function: part_emitter_clear.
 * /
function _GMLfunc_part_emitter_clear(ps, ind) {
	return part_emitter_clear(ps, ind);
}
//*/

/* _GMLfunc_part_emitter_region(ps,ind,xmin,xmax,ymin,ymax,shape,distribution)
 * Wrapper for function: part_emitter_region.
 * /
function _GMLfunc_part_emitter_region(ps, ind, xmin, xmax, ymin, ymax, shape, distribution) {
	return part_emitter_region(ps, ind, xmin, xmax, ymin, ymax, shape, distribution);
}
//*/

/* _GMLfunc_part_emitter_burst(ps,ind,parttype,number)
 * Wrapper for function: part_emitter_burst.
 * /
function _GMLfunc_part_emitter_burst(ps, ind, parttype, number) {
	return part_emitter_burst(ps, ind, parttype, number);
}
//*/

/* _GMLfunc_part_emitter_stream(ps,ind,parttype,number)
 * Wrapper for function: part_emitter_stream.
 * /
function _GMLfunc_part_emitter_stream(ps, ind, parttype, number) {
	return part_emitter_stream(ps, ind, parttype, number);
}
//*/

/* _GMLfunc_part_attractor_create(ps)
 * Wrapper for function: part_attractor_create.
 * /
function _GMLfunc_part_attractor_create(ps) {
	return part_attractor_create(ps);
}
//*/

/* _GMLfunc_part_attractor_destroy(ps,ind)
 * Wrapper for function: part_attractor_destroy.
 * /
function _GMLfunc_part_attractor_destroy(ps, ind) {
	return part_attractor_destroy(ps, ind);
}
//*/

/* _GMLfunc_part_attractor_destroy_all(ps)
 * Wrapper for function: part_attractor_destroy_all.
 * /
function _GMLfunc_part_attractor_destroy_all(ps) {
	return part_attractor_destroy_all(ps);
}
//*/

/* _GMLfunc_part_attractor_exists(ps,ind)
 * Wrapper for function: part_attractor_exists.
 * /
function _GMLfunc_part_attractor_exists(ps, ind) {
	return part_attractor_exists(ps, ind);
}
//*/

/* _GMLfunc_part_attractor_clear(ps,ind)
 * Wrapper for function: part_attractor_clear.
 * /
function _GMLfunc_part_attractor_clear(ps, ind) {
	return part_attractor_clear(ps, ind);
}
//*/

/* _GMLfunc_part_attractor_position(ps,ind,xx,yy)
 * Wrapper for function: part_attractor_position.
 * /
function _GMLfunc_part_attractor_position(ps, ind, xx, yy) {
	return part_attractor_position(ps, ind, xx, yy);
}
//*/

/* _GMLfunc_part_attractor_force(ps,ind,force,dist,kind,additive)
 * Wrapper for function: part_attractor_force.
 * /
function _GMLfunc_part_attractor_force(ps, ind, force, dist, kind, additive) {
	return part_attractor_force(ps, ind, force, dist, kind, additive);
}
//*/

/* _GMLfunc_part_destroyer_create(ps)
 * Wrapper for function: part_destroyer_create.
 * /
function _GMLfunc_part_destroyer_create(ps) {
	return part_destroyer_create(ps);
}
//*/

/* _GMLfunc_part_destroyer_destroy(ps,ind)
 * Wrapper for function: part_destroyer_destroy.
 * /
function _GMLfunc_part_destroyer_destroy(ps, ind) {
	return part_destroyer_destroy(ps, ind);
}
//*/

/* _GMLfunc_part_destroyer_destroy_all(ps)
 * Wrapper for function: part_destroyer_destroy_all.
 * /
function _GMLfunc_part_destroyer_destroy_all(ps) {
	return part_destroyer_destroy_all(ps);
}
//*/

/* _GMLfunc_part_destroyer_exists(ps,ind)
 * Wrapper for function: part_destroyer_exists.
 * /
function _GMLfunc_part_destroyer_exists(ps, ind) {
	return part_destroyer_exists(ps, ind);
}
//*/

/* _GMLfunc_part_destroyer_clear(ps,ind)
 * Wrapper for function: part_destroyer_clear.
 * /
function _GMLfunc_part_destroyer_clear(ps, ind) {
	return part_destroyer_clear(ps, ind);
}
//*/

/* _GMLfunc_part_destroyer_region(ps,ind,xmin,xmax,ymin,ymax,shape)
 * Wrapper for function: part_destroyer_region.
 * /
function _GMLfunc_part_destroyer_region(ps, ind, xmin, xmax, ymin, ymax, shape) {
	return part_destroyer_region(ps, ind, xmin, xmax, ymin, ymax, shape);
}
//*/

/* _GMLfunc_part_deflector_create(ps)
 * Wrapper for function: part_deflector_create.
 * /
function _GMLfunc_part_deflector_create(ps) {
	return part_deflector_create(ps);
}
//*/

/* _GMLfunc_part_deflector_destroy(ps,ind)
 * Wrapper for function: part_deflector_destroy.
 * /
function _GMLfunc_part_deflector_destroy(ps, ind) {
	return part_deflector_destroy(ps, ind);
}
//*/

/* _GMLfunc_part_deflector_destroy_all(ps)
 * Wrapper for function: part_deflector_destroy_all.
 * /
function _GMLfunc_part_deflector_destroy_all(ps) {
	return part_deflector_destroy_all(ps);
}
//*/

/* _GMLfunc_part_deflector_exists(ps,ind)
 * Wrapper for function: part_deflector_exists.
 * /
function _GMLfunc_part_deflector_exists(ps, ind) {
	return part_deflector_exists(ps, ind);
}
//*/

/* _GMLfunc_part_deflector_clear(ps,ind)
 * Wrapper for function: part_deflector_clear.
 * /
function _GMLfunc_part_deflector_clear(ps, ind) {
	return part_deflector_clear(ps, ind);
}
//*/

/* _GMLfunc_part_deflector_region(ps,ind,xmin,xmax,ymin,ymax)
 * Wrapper for function: part_deflector_region.
 * /
function _GMLfunc_part_deflector_region(ps, ind, xmin, xmax, ymin, ymax) {
	return part_deflector_region(ps, ind, xmin, xmax, ymin, ymax);
}
//*/

/* _GMLfunc_part_deflector_kind(ps,ind,kind)
 * Wrapper for function: part_deflector_kind.
 * /
function _GMLfunc_part_deflector_kind(ps, ind, kind) {
	return part_deflector_kind(ps, ind, kind);
}
//*/

/* _GMLfunc_part_deflector_friction(ps,ind,amount)
 * Wrapper for function: part_deflector_friction.
 * /
function _GMLfunc_part_deflector_friction(ps, ind, amount) {
	return part_deflector_friction(ps, ind, amount);
}
//*/

/* _GMLfunc_part_changer_create(ps)
 * Wrapper for function: part_changer_create.
 * /
function _GMLfunc_part_changer_create(ps) {
	return part_changer_create(ps);
}
//*/

/* _GMLfunc_part_changer_destroy(ps,ind)
 * Wrapper for function: part_changer_destroy.
 * /
function _GMLfunc_part_changer_destroy(ps, ind) {
	return part_changer_destroy(ps, ind);
}
//*/

/* _GMLfunc_part_changer_destroy_all(ps)
 * Wrapper for function: part_changer_destroy_all.
 * /
function _GMLfunc_part_changer_destroy_all(ps) {
	return part_changer_destroy_all(ps);
}
//*/

/* _GMLfunc_part_changer_exists(ps,ind)
 * Wrapper for function: part_changer_exists.
 * /
function _GMLfunc_part_changer_exists(ps, ind) {
	return part_changer_exists(ps, ind);
}
//*/

/* _GMLfunc_part_changer_clear(ps,ind)
 * Wrapper for function: part_changer_clear.
 * /
function _GMLfunc_part_changer_clear(ps, ind) {
	return part_changer_clear(ps, ind);
}
//*/

/* _GMLfunc_part_changer_region(ps,ind,xmin,xmax,ymin,ymax,shape)
 * Wrapper for function: part_changer_region.
 * /
function _GMLfunc_part_changer_region(ps, ind, xmin, xmax, ymin, ymax, shape) {
	return part_changer_region(ps, ind, xmin, xmax, ymin, ymax, shape);
}
//*/

/* _GMLfunc_part_changer_kind(ps,ind,kind)
 * Wrapper for function: part_changer_kind.
 * /
function _GMLfunc_part_changer_kind(ps, ind, kind) {
	return part_changer_kind(ps, ind, kind);
}
//*/

/* _GMLfunc_part_changer_types(ps,ind,parttype1,parttype2)
 * Wrapper for function: part_changer_types.
 * /
function _GMLfunc_part_changer_types(ps, ind, parttype1, parttype2) {
	return part_changer_types(ps, ind, parttype1, parttype2);
}
//*/

/* _GMLfunc_mplay_init_ipx()
 * Wrapper for function: mplay_init_ipx.
 * /
function _GMLfunc_mplay_init_ipx() {
	return mplay_init_ipx();
}
//*/

/* _GMLfunc_mplay_init_tcpip(addrstring)
 * Wrapper for function: mplay_init_tcpip.
 * /
function _GMLfunc_mplay_init_tcpip(addrstring) {
	return mplay_init_tcpip(addrstring);
}
//*/

/* _GMLfunc_mplay_init_modem(initstr,phonenr)
 * Wrapper for function: mplay_init_modem.
 * /
function _GMLfunc_mplay_init_modem(initstr, phonenr) {
	return mplay_init_modem(initstr, phonenr);
}
//*/

/* _GMLfunc_mplay_init_serial(portno,baudrate,stopbits,parity,flow)
 * Wrapper for function: mplay_init_serial.
 * /
function _GMLfunc_mplay_init_serial(portno, baudrate, stopbits, parity, flow) {
	return mplay_init_serial(portno, baudrate, stopbits, parity, flow);
}
//*/

/* _GMLfunc_mplay_connect_status()
 * Wrapper for function: mplay_connect_status.
 * /
function _GMLfunc_mplay_connect_status() {
	return mplay_connect_status();
}
//*/

/* _GMLfunc_mplay_end()
 * Wrapper for function: mplay_end.
 * /
function _GMLfunc_mplay_end() {
	return mplay_end();
}
//*/

/* _GMLfunc_mplay_ipaddress()
 * Wrapper for function: mplay_ipaddress.
 * /
function _GMLfunc_mplay_ipaddress() {
	return mplay_ipaddress();
}
//*/

/* _GMLfunc_mplay_session_mode(move)
 * Wrapper for function: mplay_session_mode.
 * /
function _GMLfunc_mplay_session_mode(move) {
	return mplay_session_mode(move);
}
//*/

/* _GMLfunc_mplay_session_create(sesname,playnumb,playername)
 * Wrapper for function: mplay_session_create.
 * /
function _GMLfunc_mplay_session_create(sesname, playnumb, playername) {
	return mplay_session_create(sesname, playnumb, playername);
}
//*/

/* _GMLfunc_mplay_session_find()
 * Wrapper for function: mplay_session_find.
 * /
function _GMLfunc_mplay_session_find() {
	return mplay_session_find();
}
//*/

/* _GMLfunc_mplay_session_name(numb)
 * Wrapper for function: mplay_session_name.
 * /
function _GMLfunc_mplay_session_name(numb) {
	return mplay_session_name(numb);
}
//*/

/* _GMLfunc_mplay_session_join(numb,playername)
 * Wrapper for function: mplay_session_join.
 * /
function _GMLfunc_mplay_session_join(numb, playername) {
	return mplay_session_join(numb, playername);
}
//*/

/* _GMLfunc_mplay_session_status()
 * Wrapper for function: mplay_session_status.
 * /
function _GMLfunc_mplay_session_status() {
	return mplay_session_status();
}
//*/

/* _GMLfunc_mplay_session_end()
 * Wrapper for function: mplay_session_end.
 * /
function _GMLfunc_mplay_session_end() {
	return mplay_session_end();
}
//*/

/* _GMLfunc_mplay_player_find()
 * Wrapper for function: mplay_player_find.
 * /
function _GMLfunc_mplay_player_find() {
	return mplay_player_find();
}
//*/

/* _GMLfunc_mplay_player_name(numb)
 * Wrapper for function: mplay_player_name.
 * /
function _GMLfunc_mplay_player_name(numb) {
	return mplay_player_name(numb);
}
//*/

/* _GMLfunc_mplay_player_id(numb)
 * Wrapper for function: mplay_player_id.
 * /
function _GMLfunc_mplay_player_id(numb) {
	return mplay_player_id(numb);
}
//*/

/* _GMLfunc_mplay_data_write(ind,value)
 * Wrapper for function: mplay_data_write.
 * /
function _GMLfunc_mplay_data_write(ind, value) {
	return mplay_data_write(ind, value);
}
//*/

/* _GMLfunc_mplay_data_read(ind)
 * Wrapper for function: mplay_data_read.
 * /
function _GMLfunc_mplay_data_read(ind) {
	return mplay_data_read(ind);
}
//*/

/* _GMLfunc_mplay_data_mode(guaranteed)
 * Wrapper for function: mplay_data_mode.
 * /
function _GMLfunc_mplay_data_mode(guaranteed) {
	return mplay_data_mode(guaranteed);
}
//*/

/* _GMLfunc_mplay_message_send(player,_id,val)
 * Wrapper for function: mplay_message_send.
 * /
function _GMLfunc_mplay_message_send(player, _id, val) {
	return mplay_message_send(player, _id, val);
}
//*/

/* _GMLfunc_mplay_message_send_guaranteed(player,_id,val)
 * Wrapper for function: mplay_message_send_guaranteed.
 * /
function _GMLfunc_mplay_message_send_guaranteed(player, _id, val) {
	return mplay_message_send_guaranteed(player, _id, val);
}
//*/

/* _GMLfunc_mplay_message_receive(player)
 * Wrapper for function: mplay_message_receive.
 * /
function _GMLfunc_mplay_message_receive(player) {
	return mplay_message_receive(player);
}
//*/

/* _GMLfunc_mplay_message_id()
 * Wrapper for function: mplay_message_id.
 * /
function _GMLfunc_mplay_message_id() {
	return mplay_message_id();
}
//*/

/* _GMLfunc_mplay_message_value()
 * Wrapper for function: mplay_message_value.
 * /
function _GMLfunc_mplay_message_value() {
	return mplay_message_value();
}
//*/

/* _GMLfunc_mplay_message_player()
 * Wrapper for function: mplay_message_player.
 * /
function _GMLfunc_mplay_message_player() {
	return mplay_message_player();
}
//*/

/* _GMLfunc_mplay_message_name()
 * Wrapper for function: mplay_message_name.
 * /
function _GMLfunc_mplay_message_name() {
	return mplay_message_name();
}
//*/

/* _GMLfunc_mplay_message_count(player)
 * Wrapper for function: mplay_message_count.
 * /
function _GMLfunc_mplay_message_count(player) {
	return mplay_message_count(player);
}
//*/

/* _GMLfunc_mplay_message_clear(player)
 * Wrapper for function: mplay_message_clear.
 * /
function _GMLfunc_mplay_message_clear(player) {
	return mplay_message_clear(player);
}
//*/

/* _GMLfunc_external_call(_id,arg1,arg2,...)
 * Wrapper for function: external_call.
 * /
function _GMLfunc_external_call(_id, arg1, arg2, ...) {
	switch (arguments.length) {
	case 0:
		return 0;
		break;
	case 1:
		return external_call(_id);
		break;
	case 2:
		return external_call(_id, arguments[1]);
		break;
	case 3:
		return external_call(_id, arguments[1], arguments[2]);
		break;
	case 4:
		return external_call(_id, arguments[1], arguments[2], arguments[3]);
		break;
	case 5:
		return external_call(_id, arguments[1], arguments[2], arguments[3], arguments[4]);
		break;
	case 6:
		return external_call(_id, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5]);
		break;
	case 7:
		return external_call(_id, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6]);
		break;
	case 8:
		return external_call(_id, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7]);
		break;
	case 9:
		return external_call(_id, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8]);
		break;
	case 10:
		return external_call(_id, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9]);
		break;
	case 11:
		return external_call(_id, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10]);
		break;
	case 12:
		return external_call(_id, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11]);
		break;
	case 13:
		return external_call(_id, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12]);
		break;
	case 14:
		return external_call(_id, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13]);
		break;
	case 15:
		return external_call(_id, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14]);
		break;
	case 16:
		return external_call(_id, arguments[1], arguments[2], arguments[3], arguments[4], arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14], arguments[15]);
		break;
	default:
		return 0;
		break;
	}
}
//*/

/* _GMLfunc_external_define(dll,name,calltype,restype,argnumb,arg1type,arg2type,...)
 * Wrapper for function: external_define.
 * /
function _GMLfunc_external_define(dll, name, calltype, restype, argnumb, arg1type, arg2type, ...) {
	switch (arguments.length) {
	case 0:
		return 0;
		break;
	case 1:
		return 0;
		break;
	case 2:
		return 0;
		break;
	case 3:
		return 0;
		break;
	case 4:
		return 0;
		break;
	case 5:
		return 0;
		break;
		//  case  6: return external_define(dll,name,calltype,restype,argnumb,arguments[5]); break;
	case 7:
		return external_define(dll, name, calltype, restype, argnumb, arguments[5], arguments[6]);
		break;
		//  case  8: return external_define(dll,name,calltype,restype,argnumb,arguments[5],arguments[6],arguments[7]); break;
	case 9:
		return external_define(dll, name, calltype, restype, argnumb, arguments[5], arguments[6], arguments[7], arguments[8]);
		break;
		//  case 10: return external_define(dll,name,calltype,restype,argnumb,arguments[5],arguments[6],arguments[7],arguments[8],arguments[9]); break;
	case 11:
		return external_define(dll, name, calltype, restype, argnumb, arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10]);
		break;
		//  case 12: return external_define(dll,name,calltype,restype,argnumb,arguments[5],arguments[6],arguments[7],arguments[8],arguments[9],arguments[10],arguments[11]); break;
	case 13:
		return external_define(dll, name, calltype, restype, argnumb, arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12]);
		break;
		//  case 14: return external_define(dll,name,calltype,restype,argnumb,arguments[5],arguments[6],arguments[7],arguments[8],arguments[9],arguments[10],arguments[11],arguments[12],arguments[13]); break;
	case 15:
		return external_define(dll, name, calltype, restype, argnumb, arguments[5], arguments[6], arguments[7], arguments[8], arguments[9], arguments[10], arguments[11], arguments[12], arguments[13], arguments[14]);
		break;
		//  case 16: return external_define(dll,name,calltype,restype,argnumb,arguments[5],arguments[6],arguments[7],arguments[8],arguments[9],arguments[10],arguments[11],arguments[12],arguments[13],arguments[14],arguments[15]); break;
	default:
		return 0;
		break;
	}
}
//*/

/* _GMLfunc_external_free(dllname)
 * Wrapper for function: external_free.
 * /
function _GMLfunc_external_free(dllname) {
	return external_free(dllname);
}
//*/

/* _GMLfunc_window_handle()
 * Wrapper for function: window_handle.
 * /
function _GMLfunc_window_handle() {
	return window_handle();
}
//*/

/* _GMLfunc_d3d_start()
 * Wrapper for function: d3d_start.
 * /
function _GMLfunc_d3d_start() {
	return d3d_start();
}
//*/

/* _GMLfunc_d3d_end()
 * Wrapper for function: d3d_end.
 * /
function _GMLfunc_d3d_end() {
	return d3d_end();
}
//*/

/* _GMLfunc_d3d_set_hidden(enable)
 * Wrapper for function: d3d_set_hidden.
 * /
function _GMLfunc_d3d_set_hidden(enable) {
	return d3d_set_hidden(enable);
}
//*/

/* _GMLfunc_d3d_set_perspective(enable)
 * Wrapper for function: d3d_set_perspective.
 * /
function _GMLfunc_d3d_set_perspective(enable) {
	return d3d_set_perspective(enable);
}
//*/

/* _GMLfunc_d3d_set_depth(_depth)
 * Wrapper for function: d3d_set_depth.
 * /
function _GMLfunc_d3d_set_depth(_depth) {
	return d3d_set_depth(_depth);
}
//*/

/* _GMLfunc_d3d_primitive_begin(kind)
 * Wrapper for function: d3d_primitive_begin.
 * /
function _GMLfunc_d3d_primitive_begin(kind) {
	return d3d_primitive_begin(kind);
}
//*/

/* _GMLfunc_d3d_vertex(xx,yy,zz)
 * Wrapper for function: d3d_vertex.
 * /
function _GMLfunc_d3d_vertex(xx, yy, zz) {
	return d3d_vertex(xx, yy, zz);
}
//*/

/* _GMLfunc_d3d_vertex_color(xx,yy,zz,col,alpha)
 * Wrapper for function: d3d_vertex_color.
 * /
function _GMLfunc_d3d_vertex_color(xx, yy, zz, col, alpha) {
	return d3d_vertex_color(xx, yy, zz, col, alpha);
}
//*/

/* _GMLfunc_d3d_primitive_end()
 * Wrapper for function: d3d_primitive_end.
 * /
function _GMLfunc_d3d_primitive_end() {
	return d3d_primitive_end();
}
//*/

/* _GMLfunc_d3d_primitive_begin_texture(kind,texid)
 * Wrapper for function: d3d_primitive_begin_texture.
 * /
function _GMLfunc_d3d_primitive_begin_texture(kind, texid) {
	return d3d_primitive_begin_texture(kind, texid);
}
//*/

/* _GMLfunc_d3d_vertex_texture(xx,yy,zz,xtex,ytex)
 * Wrapper for function: d3d_vertex_texture.
 * /
function _GMLfunc_d3d_vertex_texture(xx, yy, zz, xtex, ytex) {
	return d3d_vertex_texture(xx, yy, zz, xtex, ytex);
}
//*/

/* _GMLfunc_d3d_vertex_texture_color(xx,yy,zz,xtex,ytex,col,alpha)
 * Wrapper for function: d3d_vertex_texture_color.
 * /
function _GMLfunc_d3d_vertex_texture_color(xx, yy, zz, xtex, ytex, col, alpha) {
	return d3d_vertex_texture_color(xx, yy, zz, xtex, ytex, col, alpha);
}
//*/

/* _GMLfunc_d3d_draw_block(x1,y1,z1,x2,y2,z2,texid,hrepeat,vrepeat)
 * Wrapper for function: d3d_draw_block.
 * /
function _GMLfunc_d3d_draw_block(x1, y1, z1, x2, y2, z2, texid, hrepeat, vrepeat) {
	return d3d_draw_block(x1, y1, z1, x2, y2, z2, texid, hrepeat, vrepeat);
}
//*/

/* _GMLfunc_d3d_draw_cylinder(x1,y1,z1,x2,y2,z2,texid,hrepeat,vrepeat,closed,steps)
 * Wrapper for function: d3d_draw_cylinder.
 * /
function _GMLfunc_d3d_draw_cylinder(x1, y1, z1, x2, y2, z2, texid, hrepeat, vrepeat, closed, steps) {
	return d3d_draw_cylinder(x1, y1, z1, x2, y2, z2, texid, hrepeat, vrepeat, closed, steps);
}
//*/

/* _GMLfunc_d3d_draw_cone(x1,y1,z1,x2,y2,z2,texid,hrepeat,vrepeat,closed,steps)
 * Wrapper for function: d3d_draw_cone.
 * /
function _GMLfunc_d3d_draw_cone(x1, y1, z1, x2, y2, z2, texid, hrepeat, vrepeat, closed, steps) {
	return d3d_draw_cone(x1, y1, z1, x2, y2, z2, texid, hrepeat, vrepeat, closed, steps);
}
//*/

/* _GMLfunc_d3d_draw_ellipsoid(x1,y1,z1,x2,y2,z2,texid,hrepeat,vrepeat,steps)
 * Wrapper for function: d3d_draw_ellipsoid.
 * /
function _GMLfunc_d3d_draw_ellipsoid(x1, y1, z1, x2, y2, z2, texid, hrepeat, vrepeat, steps) {
	return d3d_draw_ellipsoid(x1, y1, z1, x2, y2, z2, texid, hrepeat, vrepeat, steps);
}
//*/

/* _GMLfunc_d3d_draw_wall(x1,y1,z1,x2,y2,z2,texid,hrepeat,vrepeat)
 * Wrapper for function: d3d_draw_wall.
 * /
function _GMLfunc_d3d_draw_wall(x1, y1, z1, x2, y2, z2, texid, hrepeat, vrepeat) {
	return d3d_draw_wall(x1, y1, z1, x2, y2, z2, texid, hrepeat, vrepeat);
}
//*/

/* _GMLfunc_d3d_draw_floor(x1,y1,z1,x2,y2,z2,texid,hrepeat,vrepeat)
 * Wrapper for function: d3d_draw_floor.
 * /
function _GMLfunc_d3d_draw_floor(x1, y1, z1, x2, y2, z2, texid, hrepeat, vrepeat) {
	return d3d_draw_floor(x1, y1, z1, x2, y2, z2, texid, hrepeat, vrepeat);
}
//*/

/* _GMLfunc_d3d_set_projection(xfrom,yfrom,zfrom,xto,yto,zto,xup,yup,zup)
 * Wrapper for function: d3d_set_projection.
 * /
function _GMLfunc_d3d_set_projection(xfrom, yfrom, zfrom, xto, yto, zto, xup, yup, zup) {
	return d3d_set_projection(xfrom, yfrom, zfrom, xto, yto, zto, xup, yup, zup);
}
//*/

/* _GMLfunc_d3d_set_projection_ext(xfrom,yfrom,zfrom,xto,yto,zto,xup,yup,zup,angle,aspect,znear,zfar)
 * Wrapper for function: d3d_set_projection_ext.
 * /
function _GMLfunc_d3d_set_projection_ext(xfrom, yfrom, zfrom, xto, yto, zto, xup, yup, zup, angle, aspect, znear, zfar) {
	return d3d_set_projection_ext(xfrom, yfrom, zfrom, xto, yto, zto, xup, yup, zup, angle, aspect, znear, zfar);
}
//*/

/* _GMLfunc_d3d_set_projection_ortho(xx,yy,w,h,angle)
 * Wrapper for function: d3d_set_projection_ortho.
 * /
function _GMLfunc_d3d_set_projection_ortho(xx, yy, w, h, angle) {
	return d3d_set_projection_ortho(xx, yy, w, h, angle);
}
//*/

/* _GMLfunc_d3d_set_projection_perspective(xx,yy,w,h,angle)
 * Wrapper for function: d3d_set_projection_perspective.
 * /
function _GMLfunc_d3d_set_projection_perspective(xx, yy, w, h, angle) {
	return d3d_set_projection_perspective(xx, yy, w, h, angle);
}
//*/

/* _GMLfunc_d3d_transform_set_identity()
 * Wrapper for function: d3d_transform_set_identity.
 * /
function _GMLfunc_d3d_transform_set_identity() {
	return d3d_transform_set_identity();
}
//*/

/* _GMLfunc_d3d_transform_set_translation(xt,yt,zt)
 * Wrapper for function: d3d_transform_set_translation.
 * /
function _GMLfunc_d3d_transform_set_translation(xt, yt, zt) {
	return d3d_transform_set_translation(xt, yt, zt);
}
//*/

/* _GMLfunc_d3d_transform_set_scaling(xs,ys,zs)
 * Wrapper for function: d3d_transform_set_scaling.
 * /
function _GMLfunc_d3d_transform_set_scaling(xs, ys, zs) {
	return d3d_transform_set_scaling(xs, ys, zs);
}
//*/

/* _GMLfunc_d3d_transform_set_rotation_x(angle)
 * Wrapper for function: d3d_transform_set_rotation_x.
 * /
function _GMLfunc_d3d_transform_set_rotation_x(angle) {
	return d3d_transform_set_rotation_x(angle);
}
//*/

/* _GMLfunc_d3d_transform_set_rotation_y(angle)
 * Wrapper for function: d3d_transform_set_rotation_y.
 * /
function _GMLfunc_d3d_transform_set_rotation_y(angle) {
	return d3d_transform_set_rotation_y(angle);
}
//*/

/* _GMLfunc_d3d_transform_set_rotation_z(angle)
 * Wrapper for function: d3d_transform_set_rotation_z.
 * /
function _GMLfunc_d3d_transform_set_rotation_z(angle) {
	return d3d_transform_set_rotation_z(angle);
}
//*/

/* _GMLfunc_d3d_transform_set_rotation_axis(xa,ya,za,angle)
 * Wrapper for function: d3d_transform_set_rotation_axis.
 * /
function _GMLfunc_d3d_transform_set_rotation_axis(xa, ya, za, angle) {
	return d3d_transform_set_rotation_axis(xa, ya, za, angle);
}
//*/

/* _GMLfunc_d3d_transform_add_translation(xt,yt,zt)
 * Wrapper for function: d3d_transform_add_translation.
 * /
function _GMLfunc_d3d_transform_add_translation(xt, yt, zt) {
	return d3d_transform_add_translation(xt, yt, zt);
}
//*/

/* _GMLfunc_d3d_transform_add_scaling(xs,ys,zs)
 * Wrapper for function: d3d_transform_add_scaling.
 * /
function _GMLfunc_d3d_transform_add_scaling(xs, ys, zs) {
	return d3d_transform_add_scaling(xs, ys, zs);
}
//*/

/* _GMLfunc_d3d_transform_add_rotation_x(angle)
 * Wrapper for function: d3d_transform_add_rotation_x.
 * /
function _GMLfunc_d3d_transform_add_rotation_x(angle) {
	return d3d_transform_add_rotation_x(angle);
}
//*/

/* _GMLfunc_d3d_transform_add_rotation_y(angle)
 * Wrapper for function: d3d_transform_add_rotation_y.
 * /
function _GMLfunc_d3d_transform_add_rotation_y(angle) {
	return d3d_transform_add_rotation_y(angle);
}
//*/

/* _GMLfunc_d3d_transform_add_rotation_z(angle)
 * Wrapper for function: d3d_transform_add_rotation_z.
 * /
function _GMLfunc_d3d_transform_add_rotation_z(angle) {
	return d3d_transform_add_rotation_z(angle);
}
//*/

/* _GMLfunc_d3d_transform_add_rotation_axis(xa,ya,za,angle)
 * Wrapper for function: d3d_transform_add_rotation_axis.
 * /
function _GMLfunc_d3d_transform_add_rotation_axis(xa, ya, za, angle) {
	return d3d_transform_add_rotation_axis(xa, ya, za, angle);
}
//*/

/* _GMLfunc_d3d_transform_stack_clear()
 * Wrapper for function: d3d_transform_stack_clear.
 * /
function _GMLfunc_d3d_transform_stack_clear() {
	return d3d_transform_stack_clear();
}
//*/

/* _GMLfunc_d3d_transform_stack_empty()
 * Wrapper for function: d3d_transform_stack_empty.
 * /
function _GMLfunc_d3d_transform_stack_empty() {
	return d3d_transform_stack_empty();
}
//*/

/* _GMLfunc_d3d_transform_stack_push()
 * Wrapper for function: d3d_transform_stack_push.
 * /
function _GMLfunc_d3d_transform_stack_push() {
	return d3d_transform_stack_push();
}
//*/

/* _GMLfunc_d3d_transform_stack_pop()
 * Wrapper for function: d3d_transform_stack_pop.
 * /
function _GMLfunc_d3d_transform_stack_pop() {
	return d3d_transform_stack_pop();
}
//*/

/* _GMLfunc_d3d_transform_stack_top()
 * Wrapper for function: d3d_transform_stack_top.
 * /
function _GMLfunc_d3d_transform_stack_top() {
	return d3d_transform_stack_top();
}
//*/

/* _GMLfunc_d3d_transform_stack_discard()
 * Wrapper for function: d3d_transform_stack_discard.
 * /
function _GMLfunc_d3d_transform_stack_discard() {
	return d3d_transform_stack_discard();
}
//*/

/* _GMLfunc_d3d_set_fog(enable,color,start,_end)
 * Wrapper for function: d3d_set_fog.
 * /
function _GMLfunc_d3d_set_fog(enable, color, start, _end) {
	return d3d_set_fog(enable, color, start, _end);
}
//*/

/* _GMLfunc_d3d_set_lighting(enable)
 * Wrapper for function: d3d_set_lighting.
 * /
function _GMLfunc_d3d_set_lighting(enable) {
	return d3d_set_lighting(enable);
}
//*/

/* _GMLfunc_d3d_set_shading(smooth)
 * Wrapper for function: d3d_set_shading.
 * /
function _GMLfunc_d3d_set_shading(smooth) {
	return d3d_set_shading(smooth);
}
//*/

/* _GMLfunc_d3d_set_culling(cull)
 * Wrapper for function: d3d_set_culling.
 * /
function _GMLfunc_d3d_set_culling(cull) {
	return d3d_set_culling(cull);
}
//*/

/* _GMLfunc_d3d_light_define_direction(ind,dx,dy,dz,col)
 * Wrapper for function: d3d_light_define_direction.
 * /
function _GMLfunc_d3d_light_define_direction(ind, dx, dy, dz, col) {
	return d3d_light_define_direction(ind, dx, dy, dz, col);
}
//*/

/* _GMLfunc_d3d_light_define_point(ind,xx,yy,zz,range,col)
 * Wrapper for function: d3d_light_define_point.
 * /
function _GMLfunc_d3d_light_define_point(ind, xx, yy, zz, range, col) {
	return d3d_light_define_point(ind, xx, yy, zz, range, col);
}
//*/

/* _GMLfunc_d3d_light_enable(ind,enable)
 * Wrapper for function: d3d_light_enable.
 * /
function _GMLfunc_d3d_light_enable(ind, enable) {
	return d3d_light_enable(ind, enable);
}
//*/

/* _GMLfunc_d3d_vertex_normal(xx,yy,zz,nx,ny,nz)
 * Wrapper for function: d3d_vertex_normal.
 * /
function _GMLfunc_d3d_vertex_normal(xx, yy, zz, nx, ny, nz) {
	return d3d_vertex_normal(xx, yy, zz, nx, ny, nz);
}
//*/

/* _GMLfunc_d3d_vertex_normal_color(xx,yy,zz,nx,ny,nz,col,alpha)
 * Wrapper for function: d3d_vertex_normal_color.
 * /
function _GMLfunc_d3d_vertex_normal_color(xx, yy, zz, nx, ny, nz, col, alpha) {
	return d3d_vertex_normal_color(xx, yy, zz, nx, ny, nz, col, alpha);
}
//*/

/* _GMLfunc_d3d_vertex_normal_texture(xx,yy,zz,nx,ny,nz,xtex,ytex)
 * Wrapper for function: d3d_vertex_normal_texture.
 * /
function _GMLfunc_d3d_vertex_normal_texture(xx, yy, zz, nx, ny, nz, xtex, ytex) {
	return d3d_vertex_normal_texture(xx, yy, zz, nx, ny, nz, xtex, ytex);
}
//*/

/* _GMLfunc_d3d_vertex_normal_texture_color(xx,yy,zz,nx,ny,nz,xtex,ytex,col,alpha)
 * Wrapper for function: d3d_vertex_normal_texture_color.
 * /
function _GMLfunc_d3d_vertex_normal_texture_color(xx, yy, zz, nx, ny, nz, xtex, ytex, col, alpha) {
	return d3d_vertex_normal_texture_color(xx, yy, zz, nx, ny, nz, xtex, ytex, col, alpha);
}
//*/

/* _GMLfunc_d3d_model_create()
 * Wrapper for function: d3d_model_create.
 * /
function _GMLfunc_d3d_model_create() {
	return d3d_model_create();
}
//*/

/* _GMLfunc_d3d_model_destroy(ind)
 * Wrapper for function: d3d_model_destroy.
 * /
function _GMLfunc_d3d_model_destroy(ind) {
	return d3d_model_destroy(ind);
}
//*/

/* _GMLfunc_d3d_model_clear(ind)
 * Wrapper for function: d3d_model_clear.
 * /
function _GMLfunc_d3d_model_clear(ind) {
	return d3d_model_clear(ind);
}
//*/

/* _GMLfunc_d3d_model_save(ind,fname)
 * Wrapper for function: d3d_model_save.
 * /
function _GMLfunc_d3d_model_save(ind, fname) {
	return d3d_model_save(ind, fname);
}
//*/

/* _GMLfunc_d3d_model_load(ind,fname)
 * Wrapper for function: d3d_model_load.
 * /
function _GMLfunc_d3d_model_load(ind, fname) {
	return d3d_model_load(ind, fname);
}
//*/

/* _GMLfunc_d3d_model_draw(ind,xx,yy,zz,texid)
 * Wrapper for function: d3d_model_draw.
 * /
function _GMLfunc_d3d_model_draw(ind, xx, yy, zz, texid) {
	return d3d_model_draw(ind, xx, yy, zz, texid);
}
//*/

/* _GMLfunc_d3d_model_primitive_begin(ind,kind)
 * Wrapper for function: d3d_model_primitive_begin.
 * /
function _GMLfunc_d3d_model_primitive_begin(ind, kind) {
	return d3d_model_primitive_begin(ind, kind);
}
//*/

/* _GMLfunc_d3d_model_vertex(ind,xx,yy,zz)
 * Wrapper for function: d3d_model_vertex.
 * /
function _GMLfunc_d3d_model_vertex(ind, xx, yy, zz) {
	return d3d_model_vertex(ind, xx, yy, zz);
}
//*/

/* _GMLfunc_d3d_model_vertex_color(ind,xx,yy,zz,col,alpha)
 * Wrapper for function: d3d_model_vertex_color.
 * /
function _GMLfunc_d3d_model_vertex_color(ind, xx, yy, zz, col, alpha) {
	return d3d_model_vertex_color(ind, xx, yy, zz, col, alpha);
}
//*/

/* _GMLfunc_d3d_model_vertex_texture(ind,xx,yy,zz,xtex,ytex)
 * Wrapper for function: d3d_model_vertex_texture.
 * /
function _GMLfunc_d3d_model_vertex_texture(ind, xx, yy, zz, xtex, ytex) {
	return d3d_model_vertex_texture(ind, xx, yy, zz, xtex, ytex);
}
//*/

/* _GMLfunc_d3d_model_vertex_texture_color(ind,xx,yy,zz,xtex,ytex,col,alpha)
 * Wrapper for function: d3d_model_vertex_texture_color.
 * /
function _GMLfunc_d3d_model_vertex_texture_color(ind, xx, yy, zz, xtex, ytex, col, alpha) {
	return d3d_model_vertex_texture_color(ind, xx, yy, zz, xtex, ytex, col, alpha);
}
//*/

/* _GMLfunc_d3d_model_vertex_normal(ind,xx,yy,zz,nx,ny,nz)
 * Wrapper for function: d3d_model_vertex_normal.
 * /
function _GMLfunc_d3d_model_vertex_normal(ind, xx, yy, zz, nx, ny, nz) {
	return d3d_model_vertex_normal(ind, xx, yy, zz, nx, ny, nz);
}
//*/

/* _GMLfunc_d3d_model_vertex_normal_color(ind,xx,yy,zz,nx,ny,nz,col,alpha)
 * Wrapper for function: d3d_model_vertex_normal_color.
 * /
function _GMLfunc_d3d_model_vertex_normal_color(ind, xx, yy, zz, nx, ny, nz, col, alpha) {
	return d3d_model_vertex_normal_color(ind, xx, yy, zz, nx, ny, nz, col, alpha);
}
//*/

/* _GMLfunc_d3d_model_vertex_normal_texture(ind,xx,yy,zz,nx,ny,nz,xtex,ytex)
 * Wrapper for function: d3d_model_vertex_normal_texture.
 * /
function _GMLfunc_d3d_model_vertex_normal_texture(ind, xx, yy, zz, nx, ny, nz, xtex, ytex) {
	return d3d_model_vertex_normal_texture(ind, xx, yy, zz, nx, ny, nz, xtex, ytex);
}
//*/

/* _GMLfunc_d3d_model_vertex_normal_texture_color(ind,xx,yy,zz,nx,ny,nz,xtex,ytex,col,alpha)
 * Wrapper for function: d3d_model_vertex_normal_texture_color.
 * /
function _GMLfunc_d3d_model_vertex_normal_texture_color(ind, xx, yy, zz, nx, ny, nz, xtex, ytex, col, alpha) {
	return d3d_model_vertex_normal_texture_color(ind, xx, yy, zz, nx, ny, nz, xtex, ytex, col, alpha);
}
//*/

/* _GMLfunc_d3d_model_primitive_end(ind)
 * Wrapper for function: d3d_model_primitive_end.
 * /
function _GMLfunc_d3d_model_primitive_end(ind) {
	return d3d_model_primitive_end(ind);
}
//*/

/* _GMLfunc_d3d_model_block(ind,x1,y1,z1,x2,y2,z2,hrepeat,vrepeat)
 * Wrapper for function: d3d_model_block.
 * /
function _GMLfunc_d3d_model_block(ind, x1, y1, z1, x2, y2, z2, hrepeat, vrepeat) {
	return d3d_model_block(ind, x1, y1, z1, x2, y2, z2, hrepeat, vrepeat);
}
//*/

/* _GMLfunc_d3d_model_cylinder(ind,x1,y1,z1,x2,y2,z2,hrepeat,vrepeat,closed,steps)
 * Wrapper for function: d3d_model_cylinder.
 * /
function _GMLfunc_d3d_model_cylinder(ind, x1, y1, z1, x2, y2, z2, hrepeat, vrepeat, closed, steps) {
	return d3d_model_cylinder(ind, x1, y1, z1, x2, y2, z2, hrepeat, vrepeat, closed, steps);
}
//*/

/* _GMLfunc_d3d_model_cone(ind,x1,y1,z1,x2,y2,z2,hrepeat,vrepeat,closed,steps)
 * Wrapper for function: d3d_model_cone.
 * /
function _GMLfunc_d3d_model_cone(ind, x1, y1, z1, x2, y2, z2, hrepeat, vrepeat, closed, steps) {
	return d3d_model_cone(ind, x1, y1, z1, x2, y2, z2, hrepeat, vrepeat, closed, steps);
}
//*/

/* _GMLfunc_d3d_model_ellipsoid(ind,x1,y1,z1,x2,y2,z2,hrepeat,vrepeat,steps)
 * Wrapper for function: d3d_model_ellipsoid.
 * /
function _GMLfunc_d3d_model_ellipsoid(ind, x1, y1, z1, x2, y2, z2, hrepeat, vrepeat, steps) {
	return d3d_model_ellipsoid(ind, x1, y1, z1, x2, y2, z2, hrepeat, vrepeat, steps);
}
//*/

/* _GMLfunc_d3d_model_wall(ind,x1,y1,z1,x2,y2,z2,hrepeat,vrepeat)
 * Wrapper for function: d3d_model_wall.
 * /
function _GMLfunc_d3d_model_wall(ind, x1, y1, z1, x2, y2, z2, hrepeat, vrepeat) {
	return d3d_model_wall(ind, x1, y1, z1, x2, y2, z2, hrepeat, vrepeat);
}
//*/

/* _GMLfunc_d3d_model_floor(ind,x1,y1,z1,x2,y2,z2,hrepeat,vrepeat)
 * Wrapper for function: d3d_model_floor.
 * /
function _GMLfunc_d3d_model_floor(ind, x1, y1, z1, x2, y2, z2, hrepeat, vrepeat) {
	return d3d_model_floor(ind, x1, y1, z1, x2, y2, z2, hrepeat, vrepeat);
}
//*/
