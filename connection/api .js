
include('dotenv');

const url = '/search?query=Phone&page=1&country=US&sort_by=RELEVANCE&product_condition=ALL&is_prime=false&deals_and_discounts=NONE';
const options = {
	method: 'GET',
	headers: {
		'x-rapidapi-key': 'cb58e8db80mshc2b1b4192984bd3p1adee3jsn8eb604ccd109',
		'x-rapidapi-host': 'real-time-amazon-data.p.rapidapi.com',
		'Content-Type': 'application/json'
	}
};

try {
	const response = await fetch(url, options);
	const result = await response.text();
	console.log(result);
} catch (error) {
	console.error(error);
}