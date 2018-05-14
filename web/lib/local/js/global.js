function decimalAdjust(type, value, exp) {
    // Si la valeur de exp n'est pas définie ou vaut zéro...
    if (typeof exp === 'undefined' || +exp === 0) {
        return Math[type](value);
    }
    value = +value;
    exp = +exp;
    // Si la valeur n'est pas un nombre
    // ou si exp n'est pas un entier...
    if (isNaN(value) || !(typeof exp === 'number' && exp % 1 === 0)) {
        return NaN;
    }
    // Si la valeur est négative
    if (value < 0) {
        return -decimalAdjust(type, -value, exp);
    }
    // Décalage
    value = value.toString().split('e');
    value = Math[type](+(value[0] + 'e' + (value[1] ? (+value[1] - exp) : -exp)));
    // Décalage inversé
    value = value.toString().split('e');
    return +(value[0] + 'e' + (value[1] ? (+value[1] + exp) : exp));
}

function addZero(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

var getSummonerHistory = function(urlRequest, callback, rankUrl) {
    var content = '';
    $.ajax({
        url: urlRequest,
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            if (result['done'] == true && result['games'].length > 0) {
                $.each(result['games'], function (key, game) {
                    if (game.won == true)
                        var won = 'Victory';
                    else
                        var won = 'Defeat';
                    var duration = new Date(game.match.gameDuration * 1000);
                    content += '<tr>\
                                    <td class="hide-mobile">' + game.match.gameCreation + '</td>\
                                    <td class="img-wrapper">\
                                    <img src="' + game.champion.squareImage + '"\
                                    width="35" alt="' + game.champion.name + '"\
                                    title="' + game.champion.name + '" />\
                                    </td>\
                                    <td class="hide-mobile text-capitalize">' + game.role.toLowerCase() + '</td>\
                                    <td>' + won + '</td>\
                                    <td class="hide-mobile">' + addZero(duration.getMinutes()) + ':' + addZero(duration.getSeconds()) + '</td>\
                                </tr>';
                });
            } else {
                content = '<tr class="title"><td>It seems like Riot\'s MatchHistory System isn\'t working for now, try again later! </td></tr>';
            }
        },

        error: function (result) {
        },

        complete: function (result) {
            callback(rankUrl);
            $('#match-history').css('background-image', 'none');
            $('#match-history table tbody').append(content);
        }
    });
};

var getSummonerRanks = function(urlRequest) {
    var content = '';
    var rankedContent = '';
    var globalContent = '';
    $.ajax({
        url: urlRequest,
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            if (result['done'] == true) {
                $.each(result['ranks']['rankedStats'], function (key, value) {
                    rankedContent += '<tr>\
                                    <td>'+ key +'</td>\
                                    <td>'+ Math.round(value * 100) / 100 +'</td>\
                                </tr>';
                });
                var i = 0;
                $.each(result['ranks']['globalStats'], function (key, value) {
                    globalContent += '<tr>\
                                    <td>'+ key +'</td>';
                    if ((value > 0 && i == 1) || (value <= 0 && i != 1))
                        globalContent += '<td class="redify">';
                    else
                        globalContent += '<td class="greenify">';
                    globalContent += formatRankValue(value) +'</td>\
                                </tr>';
                    i++;
                });
            } else {
                content = '<tr class="title"><td>It seems like Riot\'s MatchHistory System isn\'t working for now, try again later! </td></tr>';
            }
        },

        error: function (result) {
        },

        complete: function (result) {
            $('#ranked-stats').css('background-image', 'none');
            $('#global-stats').css('background-image', 'none');
            $('#ranked-stats table tbody').append(rankedContent + content);
            $('#global-stats table tbody').append(globalContent + content);
        }
    });
};

var formatRankValue = function (val) {
    if (val > 0)
        return '+' + Math.round(val * 100) / 100;
    return Math.round(val * 100) / 100;
};

var getWardsStats = function(urlRequest) {
    $.ajax({
        url: urlRequest,
        type: 'GET',
        dataType: 'json',
        success: function (result) {
            console.log(result);
            if (result['done'] == true) {
                var lbls = [];
                var serieA = [];
                var serieB = [];

                for (var key in result['stats']['placed']){
                    lbls.push(key);
                    serieA.push( result['stats']['placed'][key] );
                    serieB.push( result['stats']['killed'][key] );
                }

                var data = {
                    labels: lbls,
                    series: [
                        serieA,
                        serieB
                    ]
                };

                console.log(data);

                var options = {
                    seriesBarDistance: 10,
                    axisX: {
                        showGrid: false
                    },
                    height: "245px"
                };

                var responsiveOptions = [
                    ['screen and (max-width: 640px)', {
                        seriesBarDistance: 5,
                        axisX: {
                            labelInterpolationFnc: function (value) {
                                if (value[1] != undefined)
                                    return value[0]+value[1];
                                return value[0];
                            }
                        }
                    }]
                ];

                Chartist.Bar('#chartActivity', data, options, responsiveOptions);
            } else {
                $('#chartActivity').append('<h4>Wards Statistics Are Not Available Right Now, Please Try Again Later.</h4>');
            }
        },

        error: function (result) {
            $('#chartActivity').append('<h4>Wards Statistics Are Not Available Right Now, Please Try Again Later.</h4>');
        },

        complete: function (result) {
            $('#chartActivity').css('background-image', 'none');
        }
    });
};