DROP TABLE IF EXISTS profile;
DROP TABLE IF EXISTS message;

CREATE TABLE profile (
	profileId INT UNSIGNED AUTO_INCREMENT NOT NULL,
	phone     VARCHAR(32),
	PRIMARY KEY (profileId)
);


CREATE TABLE message (
	messageId      INT UNSIGNED AUTO_INCREMENT NOT NULL,
	profileId      INT UNSIGNED                NOT NULL,
	recipientId    INT UNSIGNED                NOT NULL,
	messageContent VARCHAR(20000)              NOT NULL,
	messageDate    DATETIME                    NOT NULL,
	INDEX (recipientId),
	INDEX (profileId),
	FOREIGN KEY (recipientId) REFERENCES profile(profileId),
	FOREIGN KEY (profileId) REFERENCES profile(profileId),
	PRIMARY KEY (messageId)
);




