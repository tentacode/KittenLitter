Feature: Searching kitten is some complex stuff

    Scenario: Using the quick search, I can search for kittens from the homepage
        Given I am on "/"
        And I use the quick search to find for "Pepper"
        Then I should see 7 cats

    Scenario Outline: In advanced search, I can filter cats by genders
        Given I am on the advanced search page
        When I search for cats that are "<gender>"
        Then I should see <visibleCats> cats out of <totalCats>

        Examples:
            | gender     | visibleCats | totalCats |
            | Any gender | 9           | 100       |
            | Male       | 9           | 39        |
            | Female     | 9           | 61        |