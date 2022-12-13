<?php
// declare( strict_types=1 );

require_once( __DIR__ . "/../interface/impl/CourseBuilder.php" );
require_once( __DIR__ . "/../validator/CourseValidator.php" );
require_once( __DIR__ . "/../constant/constant.php");

class CourseService {
	private static string $tableName = 'course';

    /**
	 * Retrieve all the published courses
	 * @return array|object|stdClass[]|null
	 */
	public static function findAllCourse() {
		global $wpdb;

		return $wpdb->get_results(
			"SELECT uuid, title, video_link, content FROM " . $wpdb->prefix . self::$tableName . " WHERE course_status='publish'"
		);
	}

	/**
	 * Retrieve all the courses
	 * @return array|object|stdClass[]|null
	 */
	public static function findAllCourse4Admin() {
		global $wpdb;

		return $wpdb->get_results(
			"SELECT * FROM " . $wpdb->prefix . self::$tableName . " "
		);
	}

	/**
	 * Retrieve published course by id for user
	 */
	public static function findCourseById($request) {
		global $wpdb;

		if ( !isset( $request['uuid'] )) {
			throw new Exception( "Missing question uuid.", UNPROCESSABLE_ENTITY_ERROR );
		}

		return $wpdb->get_results(
			"SELECT uuid, title, video_link, content FROM " . $wpdb->prefix . self::$tableName . " WHERE uuid=".$request['uuid'] ." AND course_status='publish'"
		);
	}

	/**
	 * Retrieve course by id for admin
	 */
	public static function findCourseById4Admin($request) {
		global $wpdb;

		if ( !isset( $request['id'] )) {
			throw new Exception( "Missing question id.", UNPROCESSABLE_ENTITY_ERROR );
		}

		return $wpdb->get_results(
			"SELECT * FROM " . $wpdb->prefix . self::$tableName . " WHERE id=".$request['id']
		);
	}

    /**
	 * Insert an course record to wp_course.
	 * @param $request: Expect a post request
	 * @return mysqli_result|bool|int|null
	 * @throws Exception
	 */
	public static function createCourse( $request ) {
		$obj = self::parseRequest( $request );

		global $wpdb;

		$data = $obj->toArray();

		return $wpdb->insert( $wpdb->prefix . self::$tableName, $data );
	}

	/**
	 * Update course record on given id.
	 * @param $request
	 * @return bool|int|mysqli_result|resource|null
	 * @throws Exception
	 */
	public static function updateCourse( $request ) {
		if ( ! isset( $request['id'] ) ) {
			throw new Exception( "Missing question id.", UNPROCESSABLE_ENTITY_ERROR );
		}
		$obj = self::parseRequest( $request );

		global $wpdb;

		$data = $obj->toArray();

		return $wpdb->update( $wpdb->prefix . self::$tableName, $data, array('id' => $request['id']) );
	}

    /**
	 * Hard deletion on course record for a given course id.
	 * @param $request
	 * @return mysqli_result|bool|int|null
	 * @throws Exception
	 */
	public static function deleteCourse( $request ) {
		if ( ! isset( $request['id'] ) ) {
			throw new Exception( "Missing question id.", UNPROCESSABLE_ENTITY_ERROR );
		}

		global $wpdb;

		return $wpdb->delete( $wpdb->prefix . self::$tableName, array( 'id' => $request['id'] ) );
	}


    /**
	 * Parse and validate request for course model.
	 * @param $request
	 * @return Course
	 * @throws Exception
	 */
	private static function parseRequest( $request ): Course {
		if ( ! self::isSubset( $request, COURSE_PARAMS ) ) {
			throw new Exception( "Invalid Request Parameters", UNPROCESSABLE_ENTITY_ERROR );
		}
		// Parameters for coursen model
		$uuid 	    	  = $request['uuid'];
		$title    		  = $request['title'];
		$videoLink 		  = $request['video_link'];
		$content  		  = $request['content'];
		$course_status    = $request['course_status'];

		$validator = new CourseValidator();
		$validator->isUUID($uuid);
		$validator->isTitle($title);
		$validator->isVideoLink($videoLink);
		$validator->isContent($content);
		$validator->isCourseStatus($course_status);

		$obj = CourseBuilder::init()
							->uuid( $uuid )
							->courseStatus( $course_status )
                            ->title( $title )
                            ->videoLink( $videoLink )
                            ->content( $content );

		// Add acourse id to the model if it is to update course
		$obj = isset( $request['id'] ) ? $obj->id( $request['id'] ) : $obj;

		return $obj->build();
	}

    /**
	 * Check if request contains all the required parameters.
	 * @param $request
	 * @param $lookup
	 * @return bool
	 */
	private static function isSubset( $request, $lookup ): bool {
		foreach ( $lookup as $key ) {
			if ( ! array_key_exists( $key, $request ) ) {
				return false;
			}
		}

		return true;
	}
}