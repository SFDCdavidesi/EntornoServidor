const url = 'https://accuweatherstefan-skliarovv1.p.rapidapi.com/get24HoursConditionsByLocationKey';
const options = {
	method: 'POST',
	headers: {
		'content-type': 'application/x-www-form-urlencoded',
		'X-RapidAPI-Key': '3a861c504emsh79c201848419cc4p130864jsnfafa95abe79a',
		'X-RapidAPI-Host': 'AccuWeatherstefan-skliarovV1.p.rapidapi.com'
	},
	body: new URLSearchParams({
		locationKey: 'Las Rozas de Madrid'
	})
};

try {
	const response = await fetch(url, options);
	const result = await response.text();
	console.log(result);
} catch (error) {
	console.error(error);
}