CREATE TABLE
    "Card" (
        CardId SERIAL PRIMARY KEY,
        CardName VARCHAR(255),
        CardType VARCHAR(255),
        Rarity VARCHAR(255),
        CardIamge VARCHAR(255),
        ReleaseDate DATE,
        CreatedOn TIMESTAMP
    );

CREATE TABLE
    "Collection" (
        CollectionId SERIAL PRIMARY KEY,
        UserId INT REFERENCES "User"(UserId),
        CardId INT REFERENCES "Card"(CardId),
        Quantity INT,
        CreatedOn TIMESTAMP
    );

CREATE TABLE
    "Wishlist" (
        WishlistId SERIAL PRIMARY KEY,
        UserId INT REFERENCES "User"(UserId),
        CardId INT REFERENCES "Card"(CardId),
        WishPriority INT,
        CreatedOn TIMESTAMP
    );