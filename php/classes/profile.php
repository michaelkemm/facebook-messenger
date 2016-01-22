<?php

/**
 * Profile: A user account
 * A user will use their profile to send messages to other users
 * @author Michael Kemm
 */
class Profile {
	/** id for the profile, this is the primary key
	 * @var string $profileId
	 */
	private $profileId;

	/**
	 * email accociated with the user
	 * @var string $email
	 */
	private $email;

	/**
	 * phone number associated with the user
	 * @var string $phoneNumber
	 */
	private $phoneNumber;

	/**
	 * user name associated with profile
	 * @var string $userName
	 */
	private $userName;

	/**
	 * constructor for this profile
	 *
	 * @param int $newProfileId, primary key
	 * @param string $newEmail, the email associated with this profile
	 * @param string $newPhoneNumber, the phone number associated with this class
	 * @param string $newUserName, the user name
	 * @throws
	 * @throws
	 */

	public function __construct($newProfileId, $newEmail, $newPhoneNumber, $newUserName = null) {
		try {
			$this->setProfileId($newProfileId);
			$this->setEmail($newEmail);
			$this->setPhoneNumber($newPhoneNumber);
			$this->setUserName($newUserName);
		} catch(InvalidArgumentException $invalidArgument) {
			// rethrow exception to the caller
			throw(new InvalidArgumentException($invalidArgument->getMessage(),0, $invalidArgument));
		}
		catch(RangeException $invalidRange) {
			//rethrow exception to the caller
			throw(new RangeException($invalidRange->getMessage(),0, $invalidRange));
		}
		catch(Exception $exception) {
			// rethrow generic exception
			throw(new Exception($exception->getMessage(),0, $exception));
		}
	}

	/** accessor method for profile id
	 *
	 * return int value of profile id
	 */
	public function getProfileId() {
		return $this->profileId;
	}

	/**
	 * mutator method for profile id
	 * @param int $newprofileId new value of profile id
	 * @throws InvalidArgumentException if profile id is not an integer
	 * @throws RangeException if profile id is negative
	 */

	public function setProfileId($newProfileId) {
		// base case: if the profile id is null, this this is a new profile without a mySQL assigned id (yet)
		if($newProfileId === null) {
			$this->profileId = null;
		}
		//apply filter to input
		$newProfileId = filter_var($newProfileId, FILTER_VALIDATE_INT);

		// filter_var rejects the new id, throw an exception
		if($newProfileId === false) {
			throw(new InvalidArgumentException("profile id is not an integer"));
		}

		if($newProfileId <= 0) {
			throw(new RangeException("profile id must be positive"));
		}

		// if id is valid save it to the object
		$this->profileId = $newProfileId;
	}

	/**
	 * accessor method for email
	 *
	 * @return string value of email
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $newEmail new value of email
	 * @throws InvalidArgumentException if email is not a string
	 */

	public function setEmail($newEmail) {
		//apply filter to input

		$newEmail = filter_var($newEmail, FILTER_SANITIZE_STRING);
		// if filter_var rejects the new email, throw exception
		if($newEmail === false) {
			throw(InvalidArgumentException("email is not a valid email"));
		}
		if($newEmail >= 128) {
			throw(RangeException("email cannot be more than 128 characters"));
		}

		/**
		 * if email is valid save it to object
		 */
		$this->email = $newEmail;
	}

	/**
	 * accessor method for phone number
	 *
	 * @return string value of phone number
	 */

	public function getPhoneNumber() {
		return $this->phoneNumber;
	}

	/**
	 * @param string $newPhoneNumber new value of $phoneNumber
	 * @throw InvalidArgumentException if phone number is not string
	 */

	public function setPhoneNumber($newPhoneNumber) {
		//apply filter to input
		$newPhoneNumber = filter_var($newPhoneNumber, FILTER_SANITIZE_STRING);
		// if filter rejects the new phone number, throw exception
		if($newPhoneNumber === false) {
			throw(new InvalidArgumentException("phone number consists only of invalid characters"));
		}
		if($newPhoneNumber >= 32) {
			throw(RangeException("phone number cannot be more than 32 characters"));
		}
		/**
		 * if phone number is valid save it to object
		 */
		$this->phoneNumber = $newPhoneNumber;
	}

	/**
	 * accessor method for user name
	 *
	 * @return string value of user name
	 */

	public function getUserName() {
		return $this->userName;
	}

	/**
	 * @param string $newUserName new value of $userName
	 * @throws InvalidArgumentException if user name is not a string
	 */

	public function setUserName($newUserName) {
		//apply filter to input
		$newUserName = filter_var($newUserName, FILTER_SANITIZE_STRING);
		// if filter rejects the new user name, throw exception
		if($newUserName === false) {
			throw(InvalidArgumentException("user name is not a string"));
		}
		if($newUserName >= 64) {
			throw(RangeException("user name cannot exceed 64 chracters"));
		}
		/**
		 * if user name is valid save it to object
		 */
		$this->userName = $newUserName;
	}
}