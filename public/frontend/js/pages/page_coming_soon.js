var PageComingSoon = function () {
    return {
      //Coming Soon
      initPageComingSoon: function () {
			var newYear = new Date();
			newYear = new Date(2017, 2, 1);
            console.log(newYear);
			$('#defaultCountdown').countdown({until: newYear})
        }
    };
}();
