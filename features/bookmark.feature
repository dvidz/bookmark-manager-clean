Feature:
  In order to crud the bookmarks
  As a user
  I want to create, list and delete bookmarks

  Scenario: It receives a bookmark query with valid link url
    Given the endpoint url "http://127.0.0.1:8000/api/bookmark"
    When it sends a post request with valid link "https://vimeo.com/524933870"
    Then the http response code should "201"

  Scenario: It should receive a bookmark list
    Given the endpoint url "http://127.0.0.1:8000/api/bookmark/"
    When it sends a get request
    Then the http response code should "200"

  Scenario: It should receive a 204 status code
    Given the endpoint url "http://127.0.0.1:8000/api/bookmark/"
    When it sends a delete request with id "1"
    Then the http response code should "204"