<?php

require_once('vendor/autoload.php');

use Carbon\Carbon;
use Citco\Carbon as CitcoCarbon;
use CarbonExt\FiscalYear\Calculator;

// Object Instantiation
$brisbane = Carbon::today('Australia/Brisbane');
$newYorkCity = Carbon::today('America/New_York');
$dtBerlin = Carbon::today('Europe/Berlin');

$outputString = "Time difference between %s & %s: %s hours.\n";

// Date difference
printf(
    $outputString,
    "Berlin", "Brisbane, Australia",
    $dtBerlin->diffInHours($brisbane, false)
);
printf(
    $outputString,
    "Berlin", "New York City, America",
    $dtBerlin->diffInHours($newYorkCity, false)
);

$septEighteen2014 = Carbon::createFromDate(2014, 9, 18, $dtBerlin->getTimezone());

printf(
    "difference between now and %s in \n\thours: %d, \n\tdays: %d, \n\tweeks: %d, \n\tweekend days: %d, \n\tweek days: %s, \n\thuman readable: %s\n",
    $septEighteen2014->toFormattedDateString(),
    $dtBerlin->diffInHours($septEighteen2014),
    $dtBerlin->diffInDays($septEighteen2014),
    $dtBerlin->diffInWeeks($septEighteen2014),
    $dtBerlin->diffInWeekendDays($septEighteen2014),
    $dtBerlin->diffInWeekDays($septEighteen2014),
    $dtBerlin->diffForHumans($septEighteen2014)
);

// Date formatting
echo $dtBerlin->toDateString() . "\n";
echo $dtBerlin->toFormattedDateString() . "\n";
echo $dtBerlin->toTimeString() . "\n";
echo $dtBerlin->toDateTimeString() . "\n";
echo $dtBerlin->toDayDateTimeString() . "\n";
echo $dtBerlin->toRfc1036String() . "\n";
echo $dtBerlin->toAtomString() . "\n";
echo $dtBerlin->toCookieString() . "\n";
echo $dtBerlin->toRssString() . "\n";
$dtBerlin->setToStringFormat('l jS \\of F Y');
echo $dtBerlin . "\n";
echo (int)$dtBerlin->isLeapYear() . "\n";

// is* range of functions test
printf("Is yesterday? %s\n", ($dtBerlin->isYesterday()) ? "yes" : "no");
printf("Is a Thursday? %s\n", ($dtBerlin->isThursday()) ? "yes" : "no");
printf("Is in the future? %s\n", ($dtBerlin->isFuture()) ? "yes" : "no");
printf("Is a leap year? %s\n", ($dtBerlin->isLeapYear()) ? "yes" : "no");

// first and last of the month
printf("First of the month %s\n", $dtBerlin->firstOfMonth());
printf("Last of the month %s\n", $dtBerlin->lastOfMonth());

// nthOf* function test
printf("Start of the month %s\n", $dtBerlin->startOfMonth());
printf("End of the month %s\n", $dtBerlin->endOfMonth());
printf("End of the decade %s\n", $dtBerlin->endOfDecade());

// Date manipulation
print $dtBerlin->addHours(5)->addDays(2)->addWeeks(1)->addMonths(3);
print $dtBerlin->subMonths(8)->subHours(7);

// Find UK Bank Holidays
$dtLondon = CitcoCarbon::today('Europe/London');
list($date, $name) = each($dtLondon->nextBankHoliday());
printf("The next bank holiday is %s on %s\n", $name, $date);

foreach($dtLondon->getBankHolidays([2016, 2017]) as $date => $name) {
    printf("The next bank holiday is %s on %s\n", $name, $date);
}

// Find end of the current financial year
$fyCalculator = new Calculator(7, 1); /* FY starts on July 1 */
print $fyCalculator->get($dtBerlin);

