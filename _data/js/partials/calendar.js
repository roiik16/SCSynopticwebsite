var calendar = {
    
    'monthName': ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    
    '__previousDays': function (container, template, year, month) {
        
        // what was the first day of the current month?
        var firstDay = (new Date (year, month - 1, 1)).getDay ();
        
        // how many days did last month have?
        var numOfDays = (new Date (year, month - 1, 0)).getDate ();
        
        // start from the end, goes back until the last Sunday
        while (--firstDay >= 0) {
            
            var instance = $(template).clone ();
            $(instance).removeClass ('invisible');
            $(instance).find ('span').html (numOfDays--);
            $(container).find ('.calendar-days').prepend (instance);
            
        }
        
    },
    
    '__nextDays': function (container, template, weekday) {
        
        // months always start from day 1
        var monthDay = 1;
        
        // if the weekday is not Saturday (6), we fill in the rest
        while (weekday++ < 6) {
            
            var instance = $(template).clone ();
            $(instance).removeClass ('invisible');
            $(instance).find ('span').html (monthDay++);
            $(container).find ('.calendar-days').append (instance);
        }
        
    },
    
    '__populate': function (container, year, month) {
                
        // we create an instance of today
        // the format is year, month, day
        // IF THE DAY IS ZERO, IT WILL GIVE ME HOW MANY DAYS ARE IN THAT MONTH
        var d = new Date (year, month, 0);
        
        // set the attributes again to keep it accurate
        $(container).attr ({
            'data-month': d.getMonth () + 1,
            'data-year': d.getFullYear ()
        });
        
        // consolidate the month and year from the new date - so we avoid invalid values
        year = d.getFullYear ();
        month = d.getMonth () + 1;
        
        // clear out the current days
        $(container).find ('.calendar-days li:not(.invisible)').remove ();
        
        // find the header and change it
        $(container).find ('header h1').html (calendar.monthName[month - 1] + " " + year);

        // the disabled day template
        var disabled = $(container).find ('.calendar-days .disabled');

        // create the previous month days
        calendar.__previousDays (container, disabled, year, month);

        // this will give me the number of days
        var daysInMonth = d.getDate ();

        // we have a template of the calendar day
        var template = $(container).find ('.calendar-days .day');

        // loop through all the days
        for (var i = 1; i <= daysInMonth; ++i) {

            // create a copy of the template
            var instance = $(template).clone ();
            $(instance).removeClass ('invisible');

            // put the day number in the <span> element
            $(instance).find ('span').html (i);

            // add the copy to the list
            $(container).find ('.calendar-days').append (instance);

        }

        // what is the last day for this month?
        var lastDay = (new Date (year, month - 1, daysInMonth)).getDay ();
        
        // get the next month
        calendar.__nextDays (container, disabled, lastDay);

    },
    
    'build': function () {
        
        var d = new Date ();
        
        $('.calendar').each (function () {
            
            // a reference for the buttons
            var cal = this;
            
            // retrieve the year from the calendar properties
            // if it doesn't exist, get the current year
            var year = parseInt ($(this).attr ('data-year'));
            if (isNaN (year)) year = d.getFullYear ();
            
            // retrieve the month from the calendar properties
            // if it doesn't exist, get the current month
            // if we get the current month, we need to add 1 to make it accurate
            var month = parseInt ($(this).attr ('data-month'));
            if (isNaN (month)) month = d.getMonth () + 1;
            
            // call the populate method
            calendar.__populate (this, year, month);
            
            $(this).find ('header .calendar-nav.previous').click (function () {
                calendar.lastMonth (cal);
                return false;
            });
            
            $(this).find ('.calendar-nav.next').click (function () {
                calendar.nextMonth (cal);
                return false;
            });
            
        });
        
    },
    
    'nextMonth': function (container) {
        
        var d = new Date ();
        
        // retrieve the year from the calendar properties
        // if it doesn't exist, get the current year
        var year = parseInt ($(container).attr ('data-year'));
        if (isNaN (year)) year = d.getFullYear ();

        // retrieve the month from the calendar properties
        // if it doesn't exist, get the current month
        // if we get the current month, we need to add 1 to make it accurate
        var month = parseInt ($(container).attr ('data-month'));
        if (isNaN (month)) month = d.getMonth () + 1;
        
        // populate the next month: if it's beyond december, it will take care of the year
        calendar.__populate (container, year, month + 1)
        
    },
    
    'lastMonth': function (container) {
        
        var d = new Date ();
        
        // retrieve the year from the calendar properties
        // if it doesn't exist, get the current year
        var year = parseInt ($(container).attr ('data-year'));
        if (isNaN (year)) year = d.getFullYear ();

        // retrieve the month from the calendar properties
        // if it doesn't exist, get the current month
        // if we get the current month, we need to add 1 to make it accurate
        var month = parseInt ($(container).attr ('data-month'));
        if (isNaN (month)) month = d.getMonth () + 1;
        
        // populate the next month: if it's beyond january, it will take care of the year
        calendar.__populate (container, year, month - 1)
        
    }
};