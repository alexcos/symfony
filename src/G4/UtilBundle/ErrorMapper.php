<?php
/**
 * Error mapping utility
 *
 * @category Allegiant
 * @package  G4.UtilBundle
 * @author   Georgiana Gligor <g@lolaent.com>
 */
namespace G4\UtilBundle;

/**
 * Maps resweb error codes to Ajax-Symf error codes
 */
class ErrorMapper
{

    const CUSTOMER_SEARCH_NEEDS_REFINE = 667;
    const CUSTOMER_SEARCH_TOO_MANY_RESULTS = 668;
    const CART_TIMEOUT = 800; // added based on issue #1141
    const SERVICES_TIMEOUT = 850;
    const OLCI_LOGIN = 900; // @since #2407
    const OLCI_COMPLETE = 990;
    const FLIGHTS = 1000;
    const CHECKED_IN = 1050;
    const FARES = 1100;
    const WINDOW_CLOSED = 1200;
    const HOTELS = 1300;
    const HOTEL_NOT_FOUND = 1399; //we pass this error code to ajax when the selected hotel from the cart request is not found in the available hotels list
    const PRODUCTS = 1500;
    const SEATING = 2000;
    const BAGS = 2100;
    const PAYMENT = 3000;
    const PAYMENT_TIMEOUT = 3001;
    const PASSES = 3500; // the boarding passes page for online check-in
    const WARNING = 3999; // all warnings have the same code
    const WRONG_REQUEST = 4000; // this is something we do wrong in Symfony
    const DOCKET_HOTEL_FIELD_MISSING = 5001; //a hotel docket field is missing
    const DOCKET_HOTEL_FIELD_NOT_NUMERIC = 5002; // a hotel docket field should be numeric but its not
    const DOCKET_PRODUCT_FIELD_MISSING = 5003; // a product docket field is missing
    const VOUCHER_TIMEOUT = 6000; //resweb timeout or does not know vouchers
    const VOUCHER_INVALID = 6001; // voucher number does not exist
    const VOUCHER_NOT_TRANSFERABLE = 6002; // the voucher is not transferable
    const VOUCHER_EXPIRED = 6003; // voucher has expired
    const VOUCHER_BALANCE_ZERO = 6004; // the voucher balance is zero
    const VOUCHER_EXPIRE_PRIOR_TO_TRAVEL = 6005; // Travel must be completed prior to the voucher expiration
    const VOUCHER_PAYMENT = 6100; // payment with voucher failed (ex: using same voucher for different booking)
    const SYSTEM_EXCEPTION = 9900;
    const UNKNOWN = 9999;

    // @see https://sites.google.com/a/cloudtroopers.ro/lolaent-team-wiki/symfony-search-dev-info/resweb-error-codes

    //System Errors
    const RESWEB_SYSTEM_GENERAL_ERROR = 'S0000'; // General error
    const RESWEB_SYSTEM_CONTEXT_INITIALIZATION_FAILED = 'S0001'; // Context initialization failed
    const RESWEB_SYSTEM_SERVICE_LOOKUP_FAILED = 'S0002'; // Service lookup failed
    const RESWEB_SYSTEM_RESOURCE_NOT_FOUND = 'S0003'; // Resource not found
    const RESWEB_SYSTEM_PROPERTY_FILE_PATH_ERROR = 'S0004'; // Property file path error
    const RESWEB_SYSTEM_DAO_EXCEPTION = 'S0005'; // Dao exception
    const RESWEB_SYSTEM_TRUNCATION_WARNING = 'TRUNC'; // Truncation warning

    //Application Error
    const RESWEB_MULTIPLE_ERRORS = '00001'; // Multiple Errors. So assembled it in Exception Set
    const RESWEB_FATAL = 'PRD_001'; // Unable to process your request
    const RESWEB_TRANS_AVAIL_HANDLING_NOT_SUPPORTED = '00002'; // Transactional Avail Handling Not Supported

    //Common Error Codes
    const RESWEB_NO_PAYLOAD_ATTRIBUTES = '001'; // PayLoad Attributes must be populated before continuing
    const RESWEB_TRAVELER_DOCUMENT_TYPE_REQUIRED = '002'; // A Traveler Document Type is required when passing in a TravelerDoc
    const RESWEB_NO_DOCUMENT_NUMBER = '003'; // A Traveler Document Number is required when passing in a TravelerDoc
    const RESWEB_NO_TRANSACTION_IDENTIFIER = '004'; // Transaction Identifier must be populated before continuing
    const RESWEB_NO_TIMESTAMP = '005'; // Timestamp must be populated before continuing
    const RESWEB_INVALID_TIMESTAMP = '006'; // Invalid Timestamp
    const RESWEB_NO_USERPROFILE = '007'; // User Profile must be populated before continuing
    const RESWEB_NO_USERPROFILE_NAME = '008'; // User Profile (Name) must be populated before continuing
    const RESWEB_NO_APP_NAME = '009'; // App Name must be populated before continuing
    const RESWEB_NO_MODULE_NAME = '010'; // Module Name must be populated before continuing
    const RESWEB_NO_SESSION_ID = '011'; // Session ID must be populated before continuing
    const RESWEB_INVALID_MARKET_ID = '012'; // The market id passed in does not map to a valid market
    const RESWEB_INVALID_CART_ID = '013'; // The cart id passed in does not map to a valid cart
    const RESWEB_TIMEZONE_IGNORED = '014'; // The TimeZone has been ignored for the field passed in
    const RESWEB_INVALID_DATE = '015'; // The date passed in is not properly formatted
    const RESWEB_NO_EXPIRATION_DATE = '016'; // An expiration date is required when passing in a TravelerDoc
    const RESWEB_NO_TRAVELERDOC = '017'; // The TravelerDoc must be populated
    const RESWEB_NO_RPH = '018'; // A RPH is required for each Traveler
    const RESWEB_NO_FIRSTNAME = '019'; // A first name is required for each Traveler
    const RESEWB_NO_LASTNAME = '020'; // A last name is required for each Traveler
    const RESWEB_INVALID_DOB = '021'; // The date of birth of each Traveler must be before or equal to today
    const RESWEB_INVALID_IP = '022'; // A valid IPv4 or IPv6 address is required.
    const RESWEB_INVALID_EMAIL = '023'; // The email provided is not in a valid format
    const RESWEB_INVALID_BOOKING_CHANNEL_ID = '024'; // The booking channel and type combination is invalid
    const RESWEB_FAILED_RETRIEVAL_MODULE_CONFIG = '025'; // The booking channel and type combination is invalid
    const RESWEB_INVALID_MODULE_CONFIG = '026'; // Invalid module config value
    const RESWEB_UNABLE_GET_DB_LOCK = '027'; // Unable to get db_lock

    //ProductAvail Error Codes
    const RESWEB_PRODUCT_NO_ID = '100'; // Product Id(s) are mandatory
    const RESWEB_PRODUCT_ID_SHOULD_NOT_BE_ZERO = '101'; // Product Id(s) should not zero
    const RESWEB_PRODUCT_NO_TRAVEL_STARTDATE = '102'; // Travel Start Date is mandatory
    const RESWEB_PRODUCT_NO_TRAVEL_ENDDATE = '103'; // Travel End Date is mandatory
    const RESWEB_PRODUCT_INVALID_LOCATION_ID = '104'; // No Location is available for the specified id
    const RESWEB_PRODUCT_STARTDATE_IN_THE_PAST = '105'; // Travel Start Date should be greater than or equal to Current date
    const RESWEB_PRODUCT_ENDDATE_IN_THE_PAST = '106'; // Travel End Date should be greater than or equal to Current Date
    const RESWEB_PRODUCT_ENDDATE_BEFORE_STARTDATE = '107'; // Travel End Date should be greater than or equal to Travel Start Date
    const RESWEB_PRODUCT_STARTDATE_AND_ENDATE_MANDATORY = '108'; // Both Travel Start Date and Travel End Date are mandatory
    const RESWEB_PRODUCT_ALLEGIANT_BASE_EXCEPTION = '109'; // An Allegiant Base Exception has happened
    const RESWEB_PRODUCT_NOT_AVAILABLE = '110'; // Product(s) Not available
    const RESWEB_PRODUCT_LOCATION_ID_LESS_THEN_ONE = '111'; // Location Id should not be less than 1
    const RESWEB_PRODUCT_LOCATION_ID_NULL = '112'; // Location Id should not be null
    const RESWEB_PRODUCT_ID_LESS_THEN_ONE = '113'; // Product Id(s) should not be less than 1
    const RESWEB_PRODUCT_SCHEME_NOT_AVAILABLE = '114'; // Scheme Not Available for the Product Id
    const RESWEB_PRODUCT_SCHEME_NOT_AVALABLE_FROM_DB = '115'; // Scheme Not Available from Database for the Product Id
    const RESWEB_PRODUCT_TOO_MANY_SCHEMES = '116'; // Too many schemes detected for the Product
    const RESWEB_PRODUCT_ID_AND_PROD_BRAND_ID_EXCLUSIVE = '117'; // ProductID and ProductBrandID are mutually exclusive. Both of them cannot appear in input.
    const RESWEB_PRODUCT_DUPLICATE_COST_TYEP = '118'; // Duplicate cost type exist for Product Id
    const RESWEB_PRODUCT_NO_AVAIL_INPUT = '119'; // Product avail input missing
    const RESWEB_PRODUCT_NO_AVAIL_SEARCH_CRITERIA = '120'; // Product avail search criteria missing
    const RESWEB_PRODUCT_INVENTORY_NOT_AVAILABLE = '121'; // Product inventory cannot be found

    //ProductBooking Error Codes
    const RESWEB_PRODUCTBOOKING_QUANTITY_GT_ZERO = '200'; // Total Quantity must be greater than zero
    const RESWEB_PRODUCTBOOKING_GW_QUANTITY_GT_ZERO = '201'; // Guest wise quantity must be greater than zero
    const RESWEB_PRODUCTBOOKING_QUANTITY_CONFLICTS = '202'; // Total Quantity and Guest wise quantity conflicts
    const RESWEB_PRODUCTBOOKING_RES_DATE_IN_PAST = '203'; // Reservation Date should be greater than current date
    const RESWEB_PRODUCTBOOKING_INCORRECT_PRICE = '204'; // Incorrect Price Details
    const RESWEB_PRODUCTBOOKING_RES_TIME_IN_PAST = '205'; // Reservation Time should be greater than Current Time
    const RESWEB_PRODUCTBOOKING_UNIT_PRICE_CONFLICT = '206'; // Product Booking Terminated due to unit price conflict
    const RESWEB_PRODUCTBOOKING_TOTAL_PRICE_CONFLICT = '207'; // Product Booking Terminated due to total price conflict
    const RESWEB_PRODUCTBOOKING_UP_AND_TP_MISSMATCH = '208'; // Given guest wise Unit Price and Total Price does not match
    const RESWEB_PRODUCTBOOKING_TOTAL_PRICE_MISMATCH = '209'; // Conflict in inventory - Total price mismatch
    const RESWEB_PRODUCTBOOKING_RES_ID_GT_ZERO = '210'; // reservationID must be greater than zero
    const RESWEB_PRODUCTBOOKING_ORIGPRODINVID_GT_ZERO = '211'; // originalProductInvID must be greater than zero
    const RESWEB_PRODUCTBOOKING_ORIGRATEPLANID_GT_ZERO = '212'; // originalRatePlanID must be greater than zero
    const RESWEB_PRODUCTBOOKING_INVALID_CART_ID = '213'; // Given Cart ID does not exist.Unable to process product booking.
    const RESWEB_PRODUCTBOOKING_PROD_RES_ID_NOT_ZERO = '214'; // ProdResID should be 0
    const RESWEB_PRODUCTBOOKING_PRODUCT_NOT_AVAILABLE = '215'; // Product not available
    const RESWEB_PRODUCTBOOKING_INVALID_GTYPEID = '216'; // Guest type ID provided is invalid

    //ProductCancel Error Codes
    const RESWEB_PRODUCTCANCEL_CONFLICT_IN_INVENTORY = '300'; // Conflict in inventory
    const RESWEB_PRODUCTCANCEL_PRODUCTRESID_NOT_EXISTS = '301'; // Given productResID does not exist. Unable to process product cancellation
    const RESWEB_PRODUCTCANCEL_PRODUCT_ALREADY_CANCELED = '302'; // Product already cancelled
    const RESWEB_PRODUCTCANCEL_NOT_ALLOWED = '303'; // Product cannot be cancelled

    //ProductModify Error Codes
    const RESWEB_PRODUCTMODIFY_PRODRESID_GT_ZERO = '400'; // ProductResID should be greater than 0
    const RESWEB_PRODUCTMODIFY_NO_CHANGES = '401'; // No changes made

    //VehicleAvail Error Codes
    const RESWEB_VEHICLE_INVALID_BOOKING_CH_ID = '500'; // Invalid Booking Channel Id
    const RESWEB_VEHICLE_INVALID_BOOKING_TYPE_ID = '501'; // Invalid Booking Type Id
    const RESWEB_VEHICLE_CLASS_ID_LT_ONE = '502'; // Vehicle Class Id should not be less than 1 for the id :
    const RESWEB_VEHICLE_NOT_AVAILABLE = '503'; // Vehicle(s) Not available
    const RESWEB_VEHICLE_TOO_MANY_SCHEMES = '504'; // Too many schemes detected for the Vehicle
    const RESWEB_VEHICLE_SCHEME_NOT_AVAILABLE = '505'; // Scheme Not Available for the Vehicle Class Id
    const RESWEB_VEHICLE_PICKUP_DATETIME_IN_PAST = '506'; // PickupDateTime must be greater than or equal to server current time
    const RESWEB_VEHICLE_DROPOFF_DATETIME_IN_PAST = '507'; // DropoffDateTime must be greater than or equal to server current time
    const RESWEB_VEHICLE_DROPOFF_BEFORE_PICKUP = '508'; // Dropoffdatetime must be greater than pickupDateTime
    const RESWEB_VEHICLE_PICKUPLOCATIONID_INVALID = '509'; // PickupLocationID does not exist
    const RESWEB_VEHICLE_PICKUPLOCATIONIN_LT_ONE = '510'; // PickupLocationID should not be less than 1
    const RESWEB_VEHICLE_DROPOFFLOCATIONID_INVALID = '511'; // DropOffLocationID does not exist
    const RESWEB_VEHICLE_DROPOFFLOCATIONID_LT_ONE = '512'; // DropOffLocationID should not be less than 1
    const RESWEB_VEHICLE_SCHEME_NOT_AVAILABLE_FROM_DB = '513'; // Scheme Not Available from Database for the Vehicle Class Id
    const RESWEB_VEHICLE_CLASS_ID_IS_NULL = '514'; // Vehicle Class Id should not be null
    const RESWEB_VEHICLE_TYPE_ID_CANNOT_BE_USED = '515'; // Vehicle Type Id is for future use.Please pass only Vehicle Class Id
    const RESWEB_VEHICLE_VTYPEID_AND_VCLASSID_EXCL = '516'; // Vehicle type ID and VehicleClassID should be mutually exclusive
    const RESWEB_VEHICLE_PICKUP_DATE_IN_PAST = '517'; // Pick up date time should be greater than the current date
    const RESWEB_VEHICLE_SEARCH_CRITERIA_IS_NULL = '518'; // Vehicle search criteria cannot be null

    //VehicleBook Error Codes
    const RESWEB_VEHICLEBOOKING_INCORRECT_RES_ID = '600'; // Incorrect vehicle reservation id
    const RESWEB_VEHICLEBOOKING_INVENTORY_ID_LT_ONE = '601'; // Vehicle inventory id should not be less than one
    const RESWEB_VEHICLEBOOKING_RATE_PLAN_ID_LT_ONE = '602'; // Vehicle rate plan id should not be less than one
    const RESWEB_VEHICLEBOOKING_DATE_IN_PAST = '603'; // Booking date time must be greater than or equal to server current time
    const RESWEB_VEHICLEBOOKING_QUANT_LT_ONE = '604'; // Available quantity should not be less than one
    const RESWEB_VEHICLEBOOKING_AMOUNT_LT_ONE = '605'; // Total amount should not be less than one
    const RESWEB_VEHICLEBOOKING_CONFLICT_IN_INV = '606'; // Conflict in Vehicle Inventory - Total amount mismatch
    const RESWEB_VEHICLEBOOKING_CLASS_IDS_IS_EMPTY = '607'; // Vehicle class Ids should not be empty
    const RESWEB_VEHICLEBOOKING_CART_ID_LT_ONE = '608'; // Cart ID should not be less than one
    const RESWEB_VEHICLEBOOKING_DATETIME_IS_NULL = '609'; // Booking date time should not be null
    const RESWEB_VEHICLEBOOKING_PICKUP_BEFORE_BOOKING = '610'; // Pick up date time should be greater than or equal to Booking date time
    const RESWEB_VEHICLEBOOKING_CART_ID_NOT_EXISTS = '611'; // Given Cart ID does not exist
    const RESWEB_VEHICLEBOOKING_DATES_MISSMATCH = '612'; // PickupDateTime or DropOffDateTime is not same in VehicleRes and PricingAvail
    const RESWEB_VEHICLEBOOKING_VENDOR_NAME_MISSMATCH = '613'; // Inventory vendor name and passed vendor name doesn't match
    const RESWEB_VEHICLEBOOKING_MAX_BOOKDAYS_EXCEEDED = '614'; // Vehicle book days greater than maximum allowed book days

    //VehicleCancel Error Codes
    const RESWEB_VEHICLECANCEL_RESID_NOT_EXISTS = '700'; // vehicleResID does not exist
    const RESWEB_VEHICLECANCEL_ALREADY_CANCELED = '702'; // Vehicle already cancelled
    const RESWEB_VEHICLECANCEL_LOCATION_ID_NOT_EXISTS = '704'; // locationID does not exist
    const RESWEB_VEHICLECANCEL_CANNOT_CANCEL = '705'; // Vehicle cannot be cancelled
    const RESWEB_VEHICLECANCEL_NOT_REFUNDABLE = '706'; // Not Allowed since Rental Car is not refundable
    const RESWEB_VEHICLECANCEL_RES_ID_LT_ONE = '707'; // VehicleResID should not be less than 1

    //Vehicle Modify Error Codes
    const RESWEB_VEHICLEMODIFY_RES_ID_GT_0 = '800'; // VehicleResID should be greater than 0
    const RESWEB_VEHICLEMODIFY_DATE_IN_PAST = '801'; // Modify date time must be greater than or equal to server current time
    const RESWEB_VEHICLEMODIFY_DATE_IS_NULL = '802'; // Modify date time should not be null
    const RESWEB_VEHICLEMODIFY_PICKUP_LATER_THAN_MODIFY = '803'; // Pick up date time should be greater than or equal to Modify date time
    const RESWEB_VEHICLEMODIFY_VRATEPLANID_NOT_EXISTS = '804'; // vehicleRatePlanID does not exist

    //HotelAvail Error Codes
    const RESWEB_HOTEL_TOO_MANY_CHILDREN = '900'; // Number of children in a room cannot exceed the number of travelers
    const RESWEB_HOTEL_GETHOTELAVAILINPUT_NOT_POPULATED = '901'; // GetHotelAvailInput must be populated before continuing
    const RESWEB_HOTEL_ONE_ROOM_MUST_BE_IN_REQUEST = '902'; // At least one room must be submitted in this request
    const RESWEB_HOTEL_ONE_HOTEL_MUST_BE_SELECTED = '903'; // At least one Hotel or Room must be selected to continue
    const RESWEB_HOTEL_NO_HOTELS_AVAILABLE = '904'; // There are no Hotels available that meet the criteria submitted
    const RESWEB_HOTEL_CHILD_IS_NOT_BORNED = '905'; // A child's age must be greater than or equal to zero
    const RESWEB_HOTEL_INVALID_TRAVELERS_PER_ROOM = '906'; // Number of travelers in a room must be greater than zero
    const RESWEB_HOTEL_INVALID_ADULTS_PER_ROOM = '907'; // There must be at least one adult in each room requested
    const RESWEB_HOTEL_ID_GT_ZERO = '908'; // The Hotel ID must be greater than zero
    const RESWEB_HOTEL_ROOM_TYPE_ID_GT_ZERO = '909'; // The Room Type ID must be greater than zero
    const RESWEB_HOTEL_NO_ROOMS_AVAILABLE = '910'; // There are no Rooms available that meet the criteria submitted
    const RESWEB_HOTEL_NO_DISCOUNT = '911'; // A Discount could not be applied to this hotel stay due to invalid data
    const RESWEB_HOTEL_HOTELID_ROOMTYPEID_PRESENT = '912'; // Both Hotel IDs and Room Type IDs cannot be populated with in the same request
    const RESWEB_HOTEL_INVALID_HOTELMSTR = '913'; // Legacy Hotelmstr is invalid. No associated Hoteldtl records.
    const RESWEB_HOTEL_ERROR_FROM_HSBI = '914'; // Error message from remote HBSI system:
    const RESWEB_HOTEL_WARNING_FROM_HSBI = '915'; // Warning message from remote HBSI system:

    //HotelBook Error Codes
    const RESWEB_HOTELBOOKING_RESINPUT_NOT_POPULATED = '1000'; // BookHotelResInput must be populated before continuing
    const RESWEB_HOTELBOOKING_ROOM_NOT_AVAILABLE = '1001'; // This room is not available for the travel window requested
    const RESWEB_HOTELBOOKING_DIFFERENT_BOOKINGS = '1002'; // This reservation contains two different booking fulfillment requirements
    const RESWEB_HOTELBOOKING_DIFFERENT_METHODS = '1003'; // This reservation contains two different methods for booking fulfillment
    const RESWEB_HOTELBOOKING_PRICE_INCREASED = '1004'; // The price for this room has increased
    const RESWEB_HOTELBOOKING_PRICE_DECREASED = '1005'; // The price for this room has decreased
    const RESWEB_HOTELBOOKING_NO_TRAVELERS = '1006'; // There are no travelers assigned to this reservation
    const RESWEB_HOTELBOOKING_INVALID_RATE_PLAN = '1007'; // The rate plan selected is not longer valid
    const RESWEB_HOTELBOOKING_INVALID_DISCOUNT = '1008'; // The discount that was originally applied to this night is no longer valid
    const RESWEB_HOTELBOOKING_DUPLICATE_RESERVATION = '1009'; // This Hotel reservation already exists
    const RESWEB_HOTELBOOKING_CANNOT_UPDATE_RESERVATION = '1010'; // Cannot update this Hotel reservation
    const RESWEB_HOTELBOOKING_RESROOMS_NOT_POPULATED = '1011'; // HotelResRooms must be populated before continuing
    const RESWEB_HOTELBOOKING_RESROOMS_EMPTY = '1012'; // The list of HotelResRooms cannot contain an empty HotelResRoom
    const RESWEB_HOTELBOOKING_RESROOMSNIGHTS_EMPTY = '1013'; // HotelResRoomNights must be populated before continuing
    const RESWEB_HOTELBOOKING_RESROOMSTRAVELERS_EMPTY = '1014'; // HotelResRoomTravelers must be populated before continuing
    const RESWEB_HOTELBOOKING_ROOMTYPEID_INVALID = '1015'; // The RoomTypeId passed in is either empty or invalid
    const RESWEB_HOTELBOOKING_QUOTED_PRICE_NOT_PROVIDED = '1016'; // A Quoted Price must be given before continuing
    const RESWEB_HOTELBOOKING_RESDATE_NOT_PROVIDED = '1017'; // The ResDate must be populated before continuing
    const RESWEB_HOTELBOOKING_REDDATE_INVALID = '1018'; // Invalid reservation date
    const RESWEB_HOTELBOOKING_RESDATE_GT_TRAVEL_STARTD = '1019'; // Reservation Date should be greater than or equal to the travel start date
    const RESWEB_HOTELBOOKING_RESDATE_LT_TRAVEL_ENDD = '1020'; // Reservation Date should be less than the travel end date
    const RESWEB_HOTELBOOKING_HOTELDTL_NOT_EXISTS = '1021'; // There are no Hoteldtl records for this Hotel
    const RESWEB_HOTELBOOKING_HOTELRESROOMNIGHTMISSING = '1022'; // There must be a HotelResRoomNight for each date from the resStartDate up to but excluding the resEndDate
    const RESWEB_HOTELBOOKING_DIRECT_CONNECT_QOUEUE_ID = '1023'; // Direct connect queue id is NULL
    const RESWEB_HOTELBOOKING_NO_ADULT = '1024'; // There must be a adult or primary traveller

    //HotelCancel Error Codes
    const RESWEB_HOTELCANCEL_1100 = '1100'; // No details available yet
    const RESWEB_HOTELCANCEL_1101 = '1101'; // No details available yet
    const RESWEB_HOTELCANCEL_1102 = '1102'; // No details available yet
    const RESWEB_HOTELCANCEL_1103 = '1103'; // No details available yet
    const RESWEB_HOTELCANCEL_1104 = '1104'; // No details available yet
    const RESWEB_HOTELCANCEL_1105 = '1105'; // No details available yet
    const RESWEB_HOTELCANCEL_1106 = '1106'; // No details available yet
    const RESWEB_HOTELCANCEL_1107 = '1107'; // No details available yet
    const RESWEB_HOTELCANCEL_1108 = '1108'; // No details available yet
    const RESWEB_HOTELCANCEL_1109 = '1109'; // No details available yet
    const RESWEB_HOTELCANCEL_1110 = '1110'; // No details available yet
    const RESWEB_HOTELCANCEL_1111 = '1111'; // No details available yet
    const RESWEB_HOTELCANCEL_1112 = '1112'; // No details available yet
    const RESWEB_HOTELCANCEL_1113 = '1113'; // No details available yet
    const RESWEB_HOTELCANCEL_1114 = '1114'; // No details available yet

    //FlightAvail Error Codes
    const RESWEB_FLIGHT_PAX_EQUAL_ZERO = '1200'; // PAX count cannot be Zero
    const RESWEB_FLIGHT_REQUEST_DATE_IS_NULL = '1201'; // Request date should not be null
    const RESWEB_FLIGHT_REQUEST_DATE_IN_PAST = '1202'; // Request Date cannot be less than Current date
    const RESWEB_FLIGHT_REQUEST_TIME_IS_NULL = '1203'; // Request time should not be null
    const RESWEB_FLIGHT_REQUEST_TIME_IN_PAST = '1204'; // Request time must be before current time
    const RESWEB_FLIGHT_REQUEST_DATE_PLUSD_GT_4 = '1205'; // Request date plus days should not be greater than 4 days.
    const RESWEB_FLIGHT_REQUEST_DATE_PLUSM_GT_720 = '1206'; // Request time plus minutes should not be greater than 720 minutes.
    const RESWEB_FLIGHT_INVALID_AIRPORT_CODE = '1207'; // Invalid Depart and Arrival Airport codes.
    const RESWEB_FLIGHT_USED_FLIGHT_VOUCHER = '1208'; // Flight voucher already redeemed
    const RESWEB_FLIGHT_INVALID_FLIGHT_VOUCHER = '1209'; // Invalid Flight Travel voucher
    const RESWEB_FLIGHT_INVALID_FLIGHT_REQUEST = '1210'; // Invalid Flight Request Element Received
    const RESWEB_FLIGHT_INVALID_BOOKYING_TYPE = '1211'; // Invalid Booking Type/Channel Received
    const RESWEB_FLIGHT_VOUCHER_MISSMATCH = '1212'; // Flight Voucher Count not matching Pax Count
    const RESWEB_FLIGHT_INVALID_MAX_STOPS = '1213'; // Invalid Flight Max Stops Received
    const RESWEB_FLIGHT_INVALID_MARKET_ID = '1214'; // Invalid Market Id: %0
    const RESWEB_FLIGHT_AND_DEPART_ARR_REQ_EXCLUSIVE = '1215'; // Flights and DepartArriveRequests should be mutually exclusive or either of the one should be available
    const RESWEB_FLIGHT_TOO_MANY_KIDS = '1216'; // Kids Count is greater than the total passenger count
    const RESWEB_FLIGHT_MARKET_MISSMATCH = '1217'; // Mismatch in Market and Flight orgin and destination for the MarketId: %0
    const RESWEB_FLIGHT_NUMBER_IS_NULL = '1218'; // Flight number should not be null or empty
    const RESWEB_FLIGHT_NUMBER_MISSMATCH = '1219'; // The flight number property value for traveler %0 [%1] does not match a segment flight
    const RESWEB_FLIGHT_FARE_UNABLE_TO_COMPUTE = '1220'; // Unable to calculate the fare for flight number [%0]
    const RESWEB_FLIGHT_INVALID_CARRIER_CODE = '1221'; // Unsupported carrier code
    const RESWEB_FLIGHT_NO_CARRIER_CODE = '1222'; // No carrier code
    const RESWEB_MARKET_NOT_AVAILABLE = '1225'; // Market not available

    //GetSeatMaps Error codes
    const RESWEB_SEATMAP_FLIGHT_NUMBER_IS_NULL = '1300'; // Flight number should not be null
    const RESWEB_SEATMAP_FLIGHT_NUMBER_IS_EMPTY = '1301'; // Flight number is empty string
    const RESWEB_SEATMAP_DEPART_DATE_IS_NULL = '1302'; // Depart date should not be null
    const RESWEB_SEATMAP_DEPART_DATE_IS_EMPTY = '1303'; // Depart date is empty string
    const RESWEB_SEATMAP_DEPART_DATE_IN_PAST = '1304'; // Depart date needs to be today or later
    const RESWEB_SEATMAP_CARRIER_CODE_IS_NULL = '1305'; // Carrier code is null
    const RESWEB_SEATMAP_CARRIER_CODE_IS_INCORRECT = '1306'; // Carrier code is incorrect
    const RESWEB_SEATMAP_CARRIER_CODE_IS_EMPTY = '1307'; // Carrier code is empty string
    const RESWEB_SEATMAP_PRIORITY_FEE_IS_NULL = '1308'; // Priority Boarding fee is null
    const RESWEB_SEATMAP_FLIGHT_NOT_ABAILABLE = '1309'; // Flight not available for the given flight-date combination
    const RESWEB_SEATMAP_INVALID_DEPART_DATE = '1310'; // Depart date is not formatted properly. Please use the following format: YYYY-MM-DD
    const RESWEB_SEATMAP_SEATS_NOT_AVAILABLE = '1311'; // Seats not available for the given flight
    const RESWEB_SEATMAP_NO_SEAT_SELECTION_FEE = '1312'; // Seat found with no Seat Selection Fee pricing
    const RESWEB_SEATMAP_INVALID_EQUIPMENT_TYPES = '1313'; // Could not retrieve list of valid equipment types
    const RESWEB_SEATMAP_CHECKIN_EXPIRED = '1314'; // Seat selection is not available online within 60 minutes of scheduled flight departure.

    //FlightBook Error Codes
    const RESWEB_FLIGHTBOOK_TRAVELER_DETAILS_MISSING = '1400'; // Required traveler detail missing in input
    const RESWEB_FLIGHTBOOK_TOO_MANY_SPECIAL_REQUESTS = '1401'; // More than 3 special requests are not allowed
    const RESWEB_FLIGHTBOOK_PROPERTY_COUNT_NOT_SET = '1402'; // Baggage Price Component must include the property count
    const RESWEB_FLIGHTBOOK_FLIGHTNUMBER_NOT_SET = '1403'; // Seat/Priority Boarding Price Component must include flightNumber property
    const RESWEB_FLIGHTBOOK_ROW_COLUMN_NOT_SET = '1404'; // Seat Price Component must include the row and column properties
    const RESWEB_FLIGHTBOOK_PRIORITYB_WITHOUT_SEAT = '1405'; // Priority Boarding cannot be opted without Seat selection
    const RESWEB_FLIGHTBOOK_ITINERARY_NOT_EXISTS = '1406'; // Itinerary either does not exit or already canceled
    const RESWEB_FLIGHTBOOK_FLIGHT_NOT_AVAILABLE = '1407'; // Flight not available
    const RESWEB_FLIGHTBOOK_SEAT_NOT_AVAILABLE = '1408'; // Seat not available
    const RESWEB_FLIGHTBOOK_FARES_DO_NOT_MATCH = '1409'; // Fares do not match
    const RESWEB_FLIGHTBOOK_OPERATOR_CODE_NOT_EXISTS = '1410'; // OperatorCode does not exist
    const RESWEB_FLIGHTBOOK_SEQUENCENUM_LT_ONE = '1411'; // sequenceNum should not be less than 1
    const RESWEB_FLIGHTBOOK_INVALID_AIRPORT_CODE = '1412'; // Invalid Airport Code
    const RESWEB_FLIGHTBOOK_FLIGHT_TRAVELER_MISSING = '1413'; // At least one FlightTraveler is required to complete booking.
    const RESWEB_FLIGHTBOOK_FLIGHT_NOT_AVAILABLE_FOR_M = '1414'; // Flight not available for the specified market.
    const RESWEB_FLIGHTBOOK_PRICE_COMPONENT_MISSING = '1415'; // At least one PriceComponent must appear in input
    const RESWEB_FLIGHTBOOK_TOTAL_PRICE_COMP_MISSING = '1416'; // Total PriceComponent must appear in input
    const RESWEB_FLIGHTBOOK_PRICE_COMP_UNDER_TPRICE = '1417'; // At least one PriceComponent must appear under Total Price Component
    const RESWEB_FLIGHTBOOK_CHILD_EXIT_ROW = '1418'; // A child cannot sit in an exit row
    const RESWEB_FLIGHTBOOK_CARRYON_NOT_AVAILABLE = '1419'; // Carry-on purchase not available.
    const RESWEB_FLIGHTBOOK_FLIGHTNUMBER_FOR_SEAT = '1420'; // The flightNumber property must be populated when trying to reserve a Seat
    const RESWEB_FLIGHTBOOK_COLUMN_FOR_SEAT = '1421'; // The column property must be populated when trying to reserve a Seat
    const RESWEB_FLIGHTBOOK_ROW_FOR_SEAT = '1422'; // The row property must be populated when trying to reserve a Seat
    const RESWEB_FLIGHTBOOK_DEPART_DATE_FOR_SEAT = '1423'; // The departure date must be populated when trying to reserve a Seat
    const RESWEB_FLIGHTBOOK_CARRYON_NA_MISSING_SEAT = '1424'; // Carry-on purchase not available - Missing Seat Selection
    const RESWEB_FLIGHTBOOK_CARRYON_NA_MISSING_PRIO = '1425'; // Carry-on purchase not available - Missing Priority Boarding
    const RESWEB_FLIGHTBOOK_MULTIPLE_CARRYON = '1426'; // Multiple Carry-on price components specified
    const RESWEB_FLIGHTBOOK_MULTIPLE_BAG = '1427'; // Multiple Pre-paid Bag price components specified
    const RESWEB_FLIGHTBOOK_AIRPORT_BAGS = '1428'; // Airport bags cannot be booked at this time
    const RESWEB_FLIGHTBOOK_PRIORITY_WITHOUT_CARRYON = '1429'; // Priority Boarding cannot be purchased without a carry-on purchase
    const RESWEB_FLIGHTBOOK_INVALID_FLIGHT_COMPONENT = '1430'; // A flight component is invalid or missing
    const RESWEB_FLIGHTBOOK_MISSING_JOURNEY = '1431'; // A trip must have at least 1 journey
    const RESWEB_FLIGHTBOOK_MISSING_SEGMENT = '1432'; // A journey must have at least 1 segment
    const RESWEB_FLIGHTBOOK_MISSING_LEG = '1433'; // A segment must have at least 1 leg
    const RESWEB_FLIGHTBOOK_INVALID_JOURNEY_SEQ = '1434'; // One or more journey sequences is invalid
    const RESWEB_FLIGHTBOOK_INVALID_SEGMENT_SQL = '1435'; // One or more segment sequences is invalid in journey
    const RESWEB_FLIGHTBOOK_INVALID_LEG_SEQ = '1436'; // One or more leg sequences is invalid in segment
    const RESWEB_FLIGHTBOOK_TRIP_IS_REQUIRED = '1437'; // A trip is required to book a flight
    const RESWEB_FLIGHTBOOK_INVALID_TRIP_SEQ = '1438'; // One or more trip sequences are invalid
    const RESWEB_FLIGHTBOOK_CARRYON_INVALID_BAG_PRICE = '1439'; // Carry on bag price component validation input null
    const RESWEB_FLIGHTBOOK_CARRYON_INVALID_BAG_COUNT = '1440'; // Carry on bag count invalid
    const RESWEB_FLIGHTBOOK_CARRYON_INVALID_DATE = '1441'; // Carry on bag effective date invalid
    const RESWEB_FLIGHTBOOK_CARRYON_INVALID_RATE = '1442'; // Carry on bag no matching rate
    const RESWEB_FLIGHTBOOK_CHECKED_INVALID_BAG_PRICE = '1443'; // Checked airport bag price component validation input null
    const RESWEB_FLIGHTBOOK_CHECKED_INVALID_BAG_COUNT = '1444'; // Checked airport bag count invalid
    const RESWEB_FLIGHTBOOK_CHECKED_INVALID_DATE = '1445'; // Checked airport bag effective date invalid
    const RESWEB_FLIGHTBOOK_CHECKED_INVALID_RATE = '1446'; // Checked airport bag no matching rate
    const RESWEB_FLIGHTBOOK_PREPAID_INVALID_BAG_PRICE = '1447'; // Checked prepaid bag price component validation input null
    const RESWEB_FLIGHTBOOK_PREPAID_INVALID_BAG_COUNT = '1448'; // Checked prepaid bag count invalid
    const RESWEB_FLIGHTBOOK_PREPAID_INVALID_DATE = '1449'; // Checked prepaid bag effective date invalid
    const RESWEB_FLIGHTBOOK_PREPAID_INVALID_RATE = '1450'; // Checked prepaid bag no matching rate

    //MyProfile Error Codes
    const RESWEB_PROFILE_INVALID_CUSTOMER_NUMBER = '1500'; // Invalid Customer Number
    const RESWEV_PROFILE_NO_JOURNEY_AND_VOUCHERS_FOUND = '1501'; // No Journey and Credit Vouchers found for the given customer

    //Cart Error Codes
    const RESWEB_CART_INVALID_CART = '1600'; // A valid cart was not supplied
    const RESWEB_CART_PAYMENTS_REQUIRED = '1601'; // One or more payments is required to book cart
    const RESWEB_CART_RESERVATION_REQUIRED = '1602'; // A flight reservation is required to book cart
    const RESWEB_CART_INVALID_INPUT = '1603'; // A valid input was not supplied
    const RESWEB_CART_CC_PROCESSING_ERROR = '1606'; // An error occurred processing the credit card payment
    const RESWEB_CART_TOTAL_COULD_NOT_BE_RETRIEVED = '1609'; // The cart total could not be retrieved
    const RESWEB_CART_PAYMENT_TOTAL_IS_ZERO = '1610'; // The payment amount total is $0
    const RESWEB_CART_TRAVELER_PROFILE_ADULTS_LT_ZERO = '1611'; // The Traveler Profile number of adults cannot be less than 0
    const RESWEB_CART_TRAVELER_PROFILE_YOUTHS_LT_ZERO = '1612'; // The Traveler Profile number of youths cannot be less than 0
    const RESWEB_CART_TRAVELER_PROFILE_CHILDR_LT_ZERO = '1613'; // The Traveler Profile number of children cannot be less than 0
    const RESWEB_CART_TRAVELER_PROFILE_SENIORS_LT_ZERO = '1614'; // The Traveler Profile number of seniors cannot be less than 0
    const RESWEB_CART_INVALID_TRAVELER_PROFILE = '1615'; // The Traveler Profile is invalid
    const RESWEB_CART_TRAVELER_MISSING = '1616'; // The Traveler Profile must have at least one traveler
    const RESWEB_CART_CUSTOMER_MISSING = '1617'; // A customer was not provided
    const RESWEB_CART_CUSTOMER_ADDRESS_MISSING = '1618'; // A customer address was not provided
    const RESWEB_CART_TRAVELER_RPH_NOT_NUMERIC = '1619'; // Cart traveler RPH must be numeric
    const RESWEB_CART_HOTEL_TRAVELERS_MISMATCH = '1620'; // One or more hotel travelers do not match a valid cart traveler
    const RESWEB_CART_VEHICLE_TRAVELERS_MISMATCH = '1621'; // One or more vehicle travelers do not match a valid cart traveler
    const RESWEB_CART_PRODUCT_TRAVELERS_MISMATCH = '1622'; // One or more product travelers do not match a valid cart traveler
    const RESWEB_CART_HOTEL_TRAVELERS_NUMBER_MISMATCH = '1623'; // The number of hotel travelers do not match the number of cart travelers
    const RESWEB_CART_CONFIRMATION_EMAIL_ERRORS = '1624'; // One or more errors or warnings occurred sending confirmation email
    const RESWEB_CART_CUSTOMER_NUMBER_MISSING = '1625'; // A customer number was not provided
    const RESWEB_CART_FLIGHT_RPH_NOT_NUMERIC = '1626'; // Flight traveler RPH must be numeric
    const RESWEB_CART_TRAV_MISMATCH_FLIGHT_TRAV = '1627'; // One or more flight travelers do not match a valid cart traveler
    const RESWEB_CART_ERROR_SENDING_DHS = '1628'; // An error occurred sending DHS secure flight message
    const RESWEB_CART_TOTAL_MISMATCH = '1629'; // The booked itinerary total [$%0] and/or balance due [$%1] does not equal the cart total [$%2]
    const RESWEB_CART_ITINERARY_NOT_FOUND = '1630'; // The itinerary could not be found
    const RESWEB_CART_FEES_MISSING = '1631'; // One or more required fees is missing
    const RESWEB_CART_FEE_MISSING = '1632'; // A required fee is missing
    const RESWEB_CART_FLIGHT_TRAVELER_DOB_MISSING = '1633'; // Flight traveler DOB is missing
    const RESWEB_CART_CUSTOMER_LOGIN_INVALID = '1634'; // The customer login was not provided, or is not a valid email address
    const RESWEB_CART_MARKET_ID_MISSING = '1635'; // The market ID is invalid or was not specified for the cart
    const RESWEB_CART_MARKET_ID_INVALID = '1636'; // The market ID provided for the cart is invalid
    const RESWEB_CART_MARKET_ID_MISMATCH = '1637'; // The market ID provided for the cart does not match the flight reservation, or the flight reservation is improperly constructed
    const RESWEB_CART_VOUCHER_AMOUNT_IS_INVALID = '1638'; // The amount provided for voucher [%0] is invalid [voucher balance is 1%]
    const RESWEB_CART_TRAVELERS_MISSING = '1640'; // One or more cart travelers are not present in the departing flight
    const RESWEB_CART_RESERVATIONS_INAVLID_SEQ = '1641'; // The flight reservation has one or more invalid sequences
    const RESWEB_CART_REQUIRED_FEE_EXTRA = '1644'; // This cart contains a required fee [%0: %1] of value [$%2] that is not required

    // CartItems Error codes
    const RESWEB_CARTITEMS_BOOKING_TYPE_ID_INVALID = '1701'; // Cart booking type and booking channel is invalid
    const RESWEB_CARTITEMS_FLIGHT_NUMBERS_REQUIRED = '1702'; // One or more flight numbers is required for specified booking type
    const RESWEB_CARTITEMS_NEGATIVE_DCD = '1703'; // The debit card discount had a negative value

    //FlightTracker Error Codes
    const RESWEB_FLIGHTTRACKER_DEPART_DATE_MISSING = '1800'; // DepartDate is mandatory
    const RESWEB_FLIGHTTRACKER_DEPART_DATE_INVALID = '1801'; // Flight departure date is out of range
    const RESWEB_FLIGHTTRACKER_FLIGHT_NUMBER_MISSING = '1802'; // Flight Number is mandatory
    const RESWEB_FLIGHTTRACKER_CARRIER_CODE_INVALID = '1803'; // Unsupported Carrier Code
    const RESWEB_FLIGHTTRACKER_CARRIER_CODE_MANDATORY = '1804'; // CarrierCode is mandatory
    const RESWEB_FLIGHTTRACKER_FLIGHT_NOT_AVAILABLE = '1805'; // Flight Not Available

    //Profile Error Codes
    const RESWEB_PROFILE_EMAIL_REQUIRED = '1900'; // An email is required to search for existing legacy customer
    const RESWEB_PROFILE_LAST_NAME_REQUIRED = '1901'; // A last name is required to search for existing legacy customer
    const RESWEB_PROFILE_FIRST_NAME_REQUIRED = '1902'; // A first name is required to search for existing legacy customer
    const RESWEB_PROFILE_STREET_ADDRESS_REQUIRED = '1903'; // A street address is required to search for existing legacy customer
    const RESWEB_PROFILE_ZIP_CODE_REQUIRED = '1904'; // A zip code is required to search for existing legacy customer
    const RESWEB_PROFILE_PROFILE_ID_INVALID = '1906'; // An invalid profile ID was provided
    const RESWEB_PROFILE_CUSTOMER_INVALID = '1907'; // A valid customer was not provided
    const RESWEB_PROFILE_EMAIL_INVALID = '1908'; // An invalid email format was provided
    const RESWEB_PROFILE_DUPLICATE_LOGIN = '1909'; // The requested login name already exists
    const RESWEB_PROFILE_LOGIN_INVALID = '1910'; // A valid login name was not provided
    const RESWEB_PROFILE_DUPLICATE_CUSTOMERS = '1911'; // More than one customer found for the provided login name
    const RESWEB_PROFILE_IP_ADDRESS_REQUIRED = '1912'; // An IP address is required for password recovery
    const RESWEB_PROFILE_LOGIN_NAME_NOT_EMAIL = '1913'; // The login name is not a valid email format
    const RESWEB_PROFILE_LOGIN_PASSWORD_REQUIRED = '1914'; // The login password is missing
    const RESWEB_PROFILE_PASSWORD_INVALID = '1915'; // A valid password was not provided
    const RESWEB_PROFILE_PASSWORD_RESET_TOKEN_MISSING = '1916'; // A password reset token was not provided
    const RESWEB_PROFILE_SECRET_QUESTION_ANSWER_MISSING = '1917'; // The answer to the secret question was not provided
    const RESWEB_PROFILE_SECRET_QUESTION_MISSING = '1918'; // The secret question was not selected or provided
    const RESWEB_PROFILE_CUSTNBR_EMAIL_INVALID = '1919'; // Profile custnbr email no match
    const RESWEB_PROFILE_CUSTNBR_EMAIL_MISSING = '1920'; // Profile unique custnbr not found for email

    //Lookup Error Codes
    const RESWEB_LOOKUP_NOT_FOUND = '2000'; // The lookupName could not be found

    //Voucher Error Codes
    const RESWEB_VOUCHER_MISMATCH = '2100'; // A valid matching voucher could not be found
    const RESWEB_VOUCHER_NOT_TRANSFERABLE = '2101'; // The voucher is not transferable
    const RESWEB_VOUCHER_EXPIRED = '2102'; // The voucher is expired
    const RESWEB_VOUCHER_CAN_NOT_BE_USED = '2103'; // The voucher type cannot be used
    const RESWEB_VOUCHER_BALANCE_IS_ZERO = '2104'; // The voucher balance is zero
    const RESWEB_VOUCHER_NOT_ALLOWED_FOR_PAYMENT = '2105'; // The voucher is not allowed for payment
    const RESWEB_VOUCHER_CANCELED = '2106'; // The voucher has been canceled
    const RESWEB_VOUCHER_INVALID = '2107'; // The voucher is invalid
    const RESWEB_VOUCHER_VALIDATION_INPUT_IS_NULL = '2108'; // Voucher validation input is null
    const RESWEB_VOUCHER_INSUFFICIENT_BALANCE = '2109'; // The voucher requested has an insufficient balance [%0] for the amount requested [%1]
    const RESWEB_VOUCHER_EXPIRE_PRIOR_TO_TRAVEL = '2110'; // Travel must be completed prior to the voucher expiration
    //Voucher Search Error Codes
    const VOUCHERDB_SEARCH_NO_VOUCHER_FOUND = '006'; //No voucher found
    const VOUCHERDB_SEARCH_FILTER_PARAMS_MISSING = '100'; //At least one filter parameter is required
    const VOUCHERDB_SEARCH_TOO_MANY_RESULTS = '101'; //The maximum number of search results [%0] is exceeded: [%1]. Please refine your search criteria
    const VOUCHERDB_SEARCH_NBR_MIN_LENGHT = '102'; //A minimum of 3 characters is required to search by voucher number
    const INTERN_SEARCH_NEEDS_REFINE = '667'; // this is ony Warning and is triggered by g4_voucher.max_returned_vouchers limit in symfony

    //BeginCheckIn Error Codes
    const RESWEB_BEGIN_CHECKIN_INPUT_IS_EMPTY = '2200'; // BeginCheckInInput must be populated before continuing
    const RESWEB_BEGIN_CHECKIN_CONFNBR_IS_NULL = '2201'; // The confNbr provided cannot be null
    const RESWEB_BEGIN_CHECKIN_RESERVATION_NOT_FOUND = '2202'; // No reservation can be found for confirmation number [$%0]
    const RESWEB_BEGIN_CHECKIN_JOURNEY_NOT_FOUND = '2203'; // No journey can be found for journeyId [$%0]
    const RESWEB_BEGIN_CHECKIN_JOURNEY_CANCELED = '2204'; // The journey that you requested has been cancelled
    const RESWEB_BEGIN_CHECKIN_SEAT_NOT_FOUND = '2205'; // Seat [$%0] not found for flight [$%1]
    const RESWEB_BEGIN_CHECKIN_BOOKYING_TYPE_NOT_FOUND = '2206'; // Booking Type [$%0] not found
    const RESWEB_BEGIN_CHECKIN_AUTOASSIGN_FAIL_BT = '2207'; // Could not auto-assign a seat for bookingType [$%0]
    const RESWEB_BEGIN_CHECKIN_AUTOASSIGN_FAIL_SSR = '2208'; // Could not auto-assign a seat due to ssrType
    const RESWEB_BEGIN_CHECKIN_AUTOASSIGN_FAIL_EXITL1 = '2209'; // Could not auto-assign a seat due to ssrType because there are only exit rows left
    const RESWEB_BEGIN_CHECKIN_AUTOASSIGN_FAIL_EXITL2 = '2210'; // Could not auto-assign a seat due to ssrType because there are only exit, forward, or aft rows left
    const RESWEB_BEGIN_CHECKIN_AUTOASSIGN_FAIL_EXITL3 = '2211'; // Could not auto-assign a seat due to ssrType because there are only exit, forward, aft, aisle rows left
    const RESWEB_BEGIN_CHECKIN_AUTOASSIGN_FAIL_KIDS = '2212'; // Could not auto-assign seats to ensure that a child is next to an adult
    const RESWEB_BEGIN_CHECKIN_MULTIPLE_FLIGHTS_LINKED = '2213'; // There is more then one flight linked to this Journey
    const RESWEB_BEGIN_CHECKIN_MARKET_NOT_FOUND = '2215'; // Market [$%0] not found
    const RESWEB_BEGIN_CHECKIN_SEATMAPS_NOT_FOUND = '2216'; // SeatMaps not found for flight [$%0] actype [$%1] and tail [$%2]
    const RESWEB_BEGIN_CHECKIN_AUTOASSIGN_FAIL = '2217'; // Seats could not be auto-assigned to all passengers on this itinerary
    const RESWEB_BEGIN_CHECKIN_NO_FLIGHTS_FOUND = '2218'; // No flights could be found
    const RESWEB_BEGIN_CHECKIN_NO_BOOKING_CHANNEL = '2219'; // No booking channel provided
    const RESWEB_BEGIN_CHECKIN_BALANCE_DUE = '2220'; // Balance is due. Verify payment
    const RESWEB_BEGIN_CHECKIN_RESERVATION_CANCELED = '2221'; // Reservation has been canceled
    const RESWEB_BEGIN_CHECKIN_AUTOASSIGN_FAIL_EXITL4 = '2222'; // Could not auto-assign a seat due to ssrType because there are only exit, forward, or window left
    const RESWEB_BEGIN_CHECKIN_AUTOASSIGN_FAIL_EXITL5 = '2223'; // Could not auto-assign a seat due to ssrType because there are only exit, forward, or aisle, or armrest left
    const RESWEB_BEGIN_CHECKIN_AUTOASSIGN_FAIL_EXITL6 = '2224'; // Could not auto-assign a seat due to ssrType because there are only exit left or not a child that is next to an adult

    //GetJourneysForCheckIn Error Codes
    const RESWEB_JOURNEYFORCHECKIN_NO_AIRLINE_PROXY = '2300'; // AirlineProxy for airlineCode [$%0] cannot be found
    const RESWEB_JOURNEYFORCHECKIN_AIRLINE_CODE_IS_NULL = '2301'; // AirlineCode cannot be null
    const RESWEB_JOURNEYFORCHECKIN_INPUT_IS_EMPTY = '2302'; // GetJourneysForCheckInInput must be populated before continuing
    const RESWEB_JOURNEYFORCHECKIN_CHILD_VALIDATION = '2303'; // Child names are not allowed for OLCI authentication
    const RESWEB_JOURNEYFORCHECKIN_CHECKIN_OFF = '2304'; // Online Checkin is turned off through AIS
    const RESWEB_JOURNEYFORCHECKIN_PERIOD_SMALLER = '2305'; // Flight has passed the online check in period
    const RESWEB_JOURNEYFORCHECKIN_PERIOD_LARGER = '2306'; // There are no flights on the itinerary departing within 24 hours
    const RESWEB_JOURNEYFORCHECKIN_NO_ITINERARY = '2307'; // No itinerary found for traveler name
    const RESWEB_JOURNEYFORCHECKIN_FLIGHT_DEPARTED = '2308'; // Flight [%s] for itinerary [%s] has already departed

    //ModifyOrder Error Codes
    const RESWEB_MODIFYORDER_INPUT_MISSING = '2400'; // ModifyOrderInput must be populated before continuing
    const RESWEB_MODIFYORDER_CHANGES_MISMATCH = '2401'; // Number of OrderChanges and OrderChangeResults mismatch
    const RESWEB_MODIFYORDER_CANCELED = '2402'; // Order is canceled
    const RESWEB_MODIFYORDER_TOTAL_PRICE_MISMATCH = '2403'; // Order total quoted [$%0] and total actual [$%1] price mismatch
    const RESWEB_MODIFYORDER_NOT_FOUND = '2404'; // Order not found
    const RESWEB_MODIFYORDER_ERROR = '2405'; // Order modify unsuccessful
    const RESWEB_MODIFYORDER_ROUND_FAILED = '2406'; // Order change results round trip consolidation failed
    const RESWEB_MODIFYORDER_CONFIRMATION_FAILED = '2407'; // Order modify error sending confirmation

    //CompleteCheckIn Error Code
    const RESWEB_COMPLETECHECKIN_INPUT_MISSING = '2500'; // CompleteCheckInInput must be populated before continuing
    const RESWEB_COMPLETECHECKIN_FTID_NULL = '2501'; // The flightTravelerId provided cannot be null
    const RESWEB_COMPLETECHECKIN_FTID_EMPTY = '2502'; // The flightTravelerId provided cannot be empty
    const RESWEB_COMPLETECHECKIN_ITNMASTER_CANCELED = '2503'; // The checkIn itnmaster is canceled
    const RESWEB_COMPLETECHECKIN_ITNDETAIL_CANCELED = '2504'; // The checkIn itndetail is canceled
    const RESWEB_COMPLETECHECKIN_ITNDETAIL_BOARDED = '2505'; // The checkIn itndetail is boarded
    const RESWEB_COMPLETECHECKIN_ALREADY_CHECKED_IN = '2506'; // Traveler already checked in
    const RESWEB_COMPLETECHECKIN_JOUNEY = '2507'; // Journey no checked in
    const RESWEB_COMPLETECHECKIN_MIN_WEB_CHECKIN_FAILED = '2508'; // Failed to get configured min web check in window
    const RESWEB_COMPLETECHECKIN_NO_ADULTS = '2509'; // No adults in traveler list
    const RESWEB_COMPLETECHECKIN_ITNDETAIL_MISSING = '2510'; // Itndetail is not found

    //RequestSeat Error Code
    const RESWEB_REQUESTSEAT_INPUT_MISSING = '2600'; // RequestSeatInput must be populated before continuing
    const RESWEB_REQUESTSEAT_LIST_PROP_IS_NULL = '2601'; // Null SeatRequest List property value
    const RESWEB_REQUESTSEAT_LIST_PROP_IS_EMPTY = '2602'; // Empty SeatRequest List property value
    const RESWEB_REQUESTSEAT_IS_NULL = '2603'; // SeatRequest value null
    const RESWEB_REQUESTSEAT_ASSIGNMENT_IS_NULL = '2604'; // SeatAssignment value null
    const RESWEB_REQUESTSEAT_ASSIGNMENTTYPE_IS_NULL = '2605'; // Null SeatAssignmentType property value
    const RESWEB_REQUESTSEAT_COLUMN_IS_NULL = '2606'; // Null Column property value
    const RESWEB_REQUESTSEAT_ROW_IS_NULL = '2607'; // Null Row property value
    const RESWEB_REQUESTSEAT_FLIGHTNBR = '2608'; // Null FlightNbr property value
    const RESWEB_REQUESTSEAT_ALREADY_CHECKED_IN = '2609'; // Traveler already checked in
    const RESWEB_REQUESTSEAT_FLIGHTNBR_MISSING = '2610'; // No flight number

    //ModifyFlight Error Codes
    const RESWEB_MODIFYFLIGHT_FLIGHTCHANGE_IS_NULL = '2700'; // FlightChange must not be null
    const RESWEB_MODIFYFLIGHT_FLIGHTCHANGE_UNKNOWN = '2701'; // FlightChange type unknown
    const RESWEB_MODIFYFLIGHT_FLIGHTNBR_IS_NULL = '2702'; // FlightNbr attribute must not be null
    const RESWEB_MODIFYFLIGHT_FLIGHTNBR_IS_EMPTY = '2703'; // FlightNbr attribute must not be empty
    const RESWEB_MODIFYFLIGHT_BAG_COUNT_MISSING = '2704'; // Missing bag count property
    const RESWEB_MODIFYFLIGHT_SEAT_ROW_MISSING = '2705'; // Missing seat row property
    const RESWEB_MODIFYFLIGHT_SEAT_COL_MISSING = '2706'; // Missing seat col property
    const RESWEB_MODIFYFLIGHT_BAG_COUNT_IS_NULL = '2707'; // Null bag count property value
    const RESWEB_MODIFYFLIGHT_SEAT_ROW_IS_NULL = '2708'; // Null seat row property value
    const RESWEB_MODIFYFLIGHT_SEAT_COL_IS_NULL = '2709'; // Null seat col property value
    const RESWEB_MODIFYFLIGHT_BAG_COUNT_NOT_NUMERIC = '2710'; // Non-numeric bag count property value
    const RESWEB_MODIFYFLIGHT_BAG_COUNT_LT_ONE = '2711'; // Bag count property value is less than one
    const RESWEB_MODIFYFLIGHT_SEAT_ROW_IS_EMPTY = '2712'; // Empty seat row property value
    const RESWEB_MODIFYFLIGHT_SEAT_COL_IS_EMPTY = '2713'; // Empty seat col property value
    const RESWEB_MODIFYFLIGHT_MULTIPLE_BAG = '2714'; // Multiple bag count properties detected
    const RESWEB_MODIFYFLIGHT_MULTIPLE_SEAT_ROW = '2715'; // Multiple seat row properties detected
    const RESWEB_MODIFYFLIGHT_MULTIPLE_SEAT_COL = '2716'; // Multiple seat col properties detected
    const RESWEB_MODIFYFLIGHT_DUPLICATE_RPH = '2717'; // Duplicate rph found in FlightChange list
    const RESWEB_MODIFYFLIGHT_FLIGHTCHANGE_RPH_UNKNOWN = '2718'; // Unknown FlightChange rph returned from AirlineProxy
    const RESWEB_MODIFYFLIGHT_DUPLICATE_FLIGHTCHANGE = '2719'; // Duplicate FlightChange found by type/journey/flightnbr/flightraveler
    const RESWEB_MODIFYFLIGHT_FLIGHTCHANGE_IT_MISMATCH = '2720'; // FlightChange for a different itinerary found
    const RESWEB_MODIFYFLIGHT_FLIGHTCHANGE_IT_CANCELLED = '2721'; // FlightChange itinerary is cancelled
    const RESWEB_MODIFYFLIGHT_FLIGHTCHANGE_IT_NA = '2722'; // No itinerary found for any FlightChange journey
    const RESWEB_MODIFYFLIGHT_JOURNEY_NOT_FOUND = '2723'; // FlightChange journey not found
    const RESWEB_MODIFYFLIGHT_JOURNEY_CANCELED = '2724'; // FlightChange journey is canceled
    const RESWEB_MODIFYFLIGHT_FLIGHTTRAVELER_NOT_FOUND = '2725'; // FlightChange flightTraveler not found
    const RESWEB_MODIFYFLIGHT_FLIGHTTRAVELER_MISMATCH = '2726'; // FlightChange flightTraveler and flightNbr mismatch
    const RESWEB_MODIFYFLIGHT_FLIGHTTRAVELER_CANCELED = '2727'; // FlightChange flightTraveler is canceled
    const RESWEB_MODIFYFLIGHT_FLIGHTTRAVELER_BOARDED = '2728'; // FlightChange flightTraveler is boarded
    const RESWEB_MODIFYFLIGHT_FLIGHTTRAVELER_CHECKEDIN = '2729'; // FlightChange flightTraveler is checked in
    const RESWEB_MODIFYFLIGHT_PRIORITY_ERROR = '2730'; // FlightChange priority boarding requires carry on bags
    const RESWEB_MODIFYFLIGHT_SEAT_SELECTION_SOFT_LOCKS = '2731'; // FlightChange seat selection does not match flight traveler soft locks
    const RESWEB_MODIFYFLIGHT_SEAT_SELECTION_TAKEN = '2732'; // FlightChange seat selection taken
    const RESWEB_MODIFYFLIGHT_PRIORITY_DUPLICATE = '2733'; // FlightChange priority boarding is already purchased
    const RESWEB_MODIFYFLIGHT_CARRYON_DUPLICATE = '2734'; // FlightChange prepaid carry-on is already purchased
    const RESWEB_MODIFYFLIGHT_ACTUAL_PRICE_ERROR = '2735'; // FlightChange unable to determine actual price
    const RESWEB_MODIFYFLIGHT_CHANGE_TYPE_ERROR = '2736'; // FlightChange unsupported change type
    const RESWEB_MODIFYFLIGHT_VALIDATOR_ERROR = '2737'; // FlightChange failed validator test
    const RESWEB_MODIFYFLIGHT_BAG_RATE_MISSING = '2738'; // Bag rate not available for bag count
    const RESWEB_MODIFYFLIGHT_SEAT_SELECTION_SAME = '2739'; // FlightChange seat selection is current seat

    const RESWEB_PAYMENT_TOTAL_MISMATCH = '2800'; // The supplied payment total [$%0] does not equal the itinerary total [$%1]
    const RESWEB_PAYMENT_TYPE_NOT_SUPPORTED = '2801'; // The provided payment type is not supported
    const RESWEB_PAYMENT_MULTIPLE_CC_NOT_SUPPORTED = '2802'; // Multiple credit card payments is not supported
    const RESWEB_PAYMENT_INVALID_VOUCHER = '2803'; // The provided voucher cannot be used for payment
    const RESWEB_PAYMENT_CREDIT_CARD_DECLINED = '2804'; // The credit card supplied was declined or failed authorization
    const RESWEB_PAYMENT_AMOUNT_NEGATIVE = '2805'; // The payment amount cannot be less than or equal to zero
    const RESWEB_PAYMENT_TIMEOUT_AUTH_SERVICE = '2806'; // An error occurred communicating with the authorization service
    const RESWEB_PAYMENT_TIMEOUT_FRAUD_SERVICE = '2807'; // An error occurred communicating with the fraud service
    const RESWEB_PAYMENT_MISSING_PAYMENT_TYPE = '2808'; // Payment Type not found for the given id
    const RESWEB_PAYMENT_TIMEOUT_PAYMENT_LOOKUP_SERVICE = '2809'; // An error occurred communicating with the payment lookup service
    const RESWEB_PAYMENT_NOT_DEBIT_CARD = '2810'; // The card number provided is not a debit card

    //CustComsBLL Error Codes
    const RESWEB_CUSTOMBLL_MISSING = '2900'; // No CustComBLL implementation for specified module
    const RESWEB_CUSTOMBLL_ERROR = '2901'; // Error creating CustComsBLL implemenation for ExactTarget
    const RESWEB_CUSTOMBLL_AUTH_KEYS_MISMATCH = '2902'; // CustComsBLLExactTargetImpl SendOnlineCheckInNotifications input and configured authorization keys mismatch
    const RESWEB_CUSTOMBLL_NOTHING_TO_SEND = '2903'; // CustComsBLLExactTargetImpl SendOnlineCheckInNotifications found nothing to send
    const RESWEB_CUSTOMBLL_API_EXECUTION_FAILURE = '2904'; // CustComsBLLExactTargetImpl API execution failure
    const RESWEB_CUSTOMBLL_CONFIRMATION_FAILURE = '2905'; // Custcomsbll null send confirmation input
    const RESWEB_CUSTOMBLL_OLCI_FAILURE = '2906'; // Custcomsbll null send olci_notifications_input

    // flight alerts validations
    const VALIDATION_ALERTS_ALREADY_ARRIVED = 1;
    const VALIDATION_ALERTS_ALREADY_DEPARTED = 2;
    const VALIDATION_ALERTS_ALREADY_DEPARTED_BOTH = 3;
    const VALIDATION_ALERTS_PAST_DATE = 4;
    const VALIDATION_ALERTSEARCH_NO_ALERT = 5;
    const VALIDATION_ALERTSEARCH_INVALID_COMBINATION = 6;

    // otadb
    const OTADB_CUSTOMER_SEARCH_TOO_MANY_RESULTS = '016'; //The maximum number of search results [%0] is exceeded: [%1]. Please refine your search criteria
    const OTADB_CUSTOMER_PHONE_NUMBER_LENGTH = '1612'; //The Phone Number needs to be 10 digits long
    const OTADB_CUSTOMER_RANGE_INVALID = '2100'; //Header:Range of [%0] is invalid for getCustomersByFilter request
    const OTADB_CUSTOMER_MALFORMED_FILTER_PARAMETER = "2101"; //The filter parameter must be formatted properly in order to proceed
    const OTADB_CUSTOMER_UNSUPORTED_FILTER_PARAMETER = "2102"; //The filter parameter of [%0] is not supported at this time
    const OTADB_CUSTOMER_EMPTY_FILTER_PARAMETER = "2103"; //The filter parameter of [%0] is cannot be empty
    const OTADB_CUSTOMER_INVALID_FIRSTNAME = "308"; //The Customer FirstName has invalid characters
    const OTADB_CUSTOMER_INVALID_LASTNAME = "313"; //The Customer LastName has invalid characters
    const OTADB_CUSTOMER_INVALID_EMAILADDRESS = "1205"; //The EmailAddress value format is invalid
    const OTADB_CUSTOMER_INVALID_PHONENBR = "1605"; //The Phone Nbr format is invalid
    const OTADB_CUSTOMER_LOGIN_FAILED = '1997';


    /**
     * Maps resweb error codes to Ajax-Symf codes
     *
     * @param integer $original resweb error code
     *
     * @return integer
     */
    public static function fromResweb($original)
    {
        $mapped = 0;
        switch ($original) {
            /** @see http://bugs.lolacloud.com/mantis/view.php?id=2047 */
            case self::RESWEB_BEGIN_CHECKIN_RESERVATION_NOT_FOUND :
            case self::RESWEB_BEGIN_CHECKIN_RESERVATION_CANCELED  :
            case self::RESWEB_BEGIN_CHECKIN_JOURNEY_CANCELED      :
            case self::RESWEB_JOURNEYFORCHECKIN_NO_ITINERARY      :
            case self::RESWEB_JOURNEYFORCHECKIN_PERIOD_SMALLER    :
            case self::RESWEB_JOURNEYFORCHECKIN_PERIOD_LARGER     :
            case self::RESWEB_JOURNEYFORCHECKIN_CHILD_VALIDATION  :
            case self::RESWEB_BEGIN_CHECKIN_BALANCE_DUE           :
            case self::RESWEB_JOURNEYFORCHECKIN_CHECKIN_OFF       :
            case self::RESWEB_BEGIN_CHECKIN_JOURNEY_NOT_FOUND     :
            case self::RESWEB_MODIFYORDER_TOTAL_PRICE_MISMATCH    :
            case self::RESWEB_JOURNEYFORCHECKIN_FLIGHT_DEPARTED   :
                $mapped = self::OLCI_LOGIN;
                break;
            case self::RESWEB_FLIGHTBOOK_FLIGHT_NOT_AVAILABLE   :
                $mapped = self::FLIGHTS;
                break;
            case self::RESWEB_MODIFYFLIGHT_FLIGHTTRAVELER_CHECKEDIN   :
                $mapped = self::CHECKED_IN;
                break;
            case self::RESWEB_FLIGHTBOOK_FARES_DO_NOT_MATCH     :
                $mapped = self::FARES;
                break;
            case self::RESWEB_SEATMAP_FLIGHT_NOT_ABAILABLE        :
            case self::RESWEB_SEATMAP_CHECKIN_EXPIRED             :
                $mapped = self::WINDOW_CLOSED;
                break;
            case self::RESWEB_HOTELBOOKING_ROOM_NOT_AVAILABLE      :
            case self::RESWEB_HOTELBOOKING_PRICE_INCREASED         :
            case self::RESWEB_HOTELBOOKING_PRICE_DECREASED         :
            case self::RESWEB_HOTELBOOKING_NO_ADULT                :
            case self::RESWEB_CART_HOTEL_TRAVELERS_NUMBER_MISMATCH :
                $mapped = self::HOTELS;
                break;
            case self::RESWEB_FLIGHTBOOK_SEAT_NOT_AVAILABLE     :
            case self::RESWEB_MODIFYFLIGHT_SEAT_SELECTION_TAKEN :
            case self::RESWEB_MODIFYFLIGHT_SEAT_SELECTION_SAME  :
                $mapped = self::SEATING;
                break;
            case self::RESWEB_MODIFYFLIGHT_CARRYON_DUPLICATE    :
                $mapped = self::BAGS;
                break;
            case self::RESWEB_PAYMENT_TYPE_NOT_SUPPORTED        :
            case self::RESWEB_PAYMENT_MULTIPLE_CC_NOT_SUPPORTED :
            case self::RESWEB_CART_CC_PROCESSING_ERROR          :
            case self::RESWEB_PAYMENT_CREDIT_CARD_DECLINED      :
            case self::RESWEB_PAYMENT_MISSING_PAYMENT_TYPE      :
            case self::RESWEB_PAYMENT_NOT_DEBIT_CARD            :
                $mapped = self::PAYMENT;
                break;
            case self::RESWEB_PAYMENT_TIMEOUT_AUTH_SERVICE      :
            case self::RESWEB_PAYMENT_TIMEOUT_FRAUD_SERVICE     :
            case self::RESWEB_PAYMENT_TIMEOUT_PAYMENT_LOOKUP_SERVICE :
                $mapped = self::PAYMENT_TIMEOUT;
                break;
            case self::RESWEB_PRODUCT_NOT_AVAILABLE             :
                $mapped = self::PRODUCTS;
                break;
            case self::RESWEB_CART_FEES_MISSING                 :
            case self::RESWEB_CART_FEE_MISSING                  :
            case self::RESWEB_CART_HOTEL_TRAVELERS_NUMBER_MISMATCH :
            case self::RESWEB_PAYMENT_TOTAL_MISMATCH            :
            case self::RESWEB_CART_REQUIRED_FEE_EXTRA           :
            case self::RESWEB_CARTITEMS_NEGATIVE_DCD            :
            case self::RESWEB_PAYMENT_AMOUNT_NEGATIVE           :
                $mapped = self::WRONG_REQUEST;
                break;
            case self::RESWEB_VOUCHER_MISMATCH                  :
            case self::RESWEB_VOUCHER_CANCELED                  :
            case self::RESWEB_VOUCHER_INVALID                   :
            case self::RESWEB_VOUCHER_VALIDATION_INPUT_IS_NULL  :
                $mapped = self::VOUCHER_INVALID;
                break;
            case self::RESWEB_VOUCHER_NOT_TRANSFERABLE          :
            case self::RESWEB_VOUCHER_CAN_NOT_BE_USED           :
            case self::RESWEB_VOUCHER_NOT_ALLOWED_FOR_PAYMENT   :
                $mapped = self::VOUCHER_NOT_TRANSFERABLE;
                break;
            case self::RESWEB_VOUCHER_EXPIRED                   :
                $mapped = self::VOUCHER_EXPIRED;
                break;
            case self::RESWEB_VOUCHER_EXPIRE_PRIOR_TO_TRAVEL    :
                $mapped = self::VOUCHER_EXPIRE_PRIOR_TO_TRAVEL;
                break;
            case self::RESWEB_VOUCHER_BALANCE_IS_ZERO           :
                $mapped = self::VOUCHER_BALANCE_ZERO;
                break;
            case self::RESWEB_PAYMENT_INVALID_VOUCHER           :
            case self::RESWEB_VOUCHER_INSUFFICIENT_BALANCE      :
                $mapped = self::VOUCHER_PAYMENT;
                break;
            case self::RESWEB_FATAL                             :
                $mapped = self::SYSTEM_EXCEPTION;
                break;
            default :
                $mapped = self::UNKNOWN;
                break;
        }

        return ($mapped);
    }

    /**
     * detects if there's a seat not available error in the resweb error array
     *
     * @param array $errors error list from resweb response
     *
     * @return bool
     *
     * @static
     */
    public static function seatNotAvailable(array $errors)
    {
        $notAvailable = false;
        $reswebCodes = self::extractReswebCodes($errors);

        if (in_array(self::RESWEB_FLIGHTBOOK_SEAT_NOT_AVAILABLE, $reswebCodes)) {
            $notAvailable = true;
        }

        return ($notAvailable);
    }

    /**
     * detects if there's a flight not available error in the resweb error array
     *
     * @param array $errors error list from resweb response
     *
     * @return bool
     *
     * @static
     */
    public static function flightNotAvailable(array $errors)
    {
        $notAvailable = false;
        $reswebCodes = self::extractReswebCodes($errors);

        if (in_array(self::RESWEB_FLIGHTBOOK_FLIGHT_NOT_AVAILABLE, $reswebCodes)) {
            $notAvailable = true;
        }

        return ($notAvailable);
    }

    /**
     * detects if there's a fares do not match error in the resweb error array
     *
     * @param array $errors error list from resweb response
     *
     * @return bool
     *
     * @static
     */
    public static function faresDoNotMatch(array $errors)
    {
        $errorExists = false;
        $reswebCodes = self::extractReswebCodes($errors);

        if (in_array(self::RESWEB_FLIGHTBOOK_FARES_DO_NOT_MATCH, $reswebCodes)) {
            $errorExists = true;
        }

        return ($errorExists);
    }

    /**
     * Detects if the error is caused by a price problem
     *
     * @param array $errors error list from resweb response
     *
     * @return bool
     *
     * @static
     */
    public static function priceChanged(array $errors)
    {
        $priceErrors = array(
            self::RESWEB_PRODUCTBOOKING_INCORRECT_PRICE,
            self::RESWEB_PRODUCTBOOKING_UNIT_PRICE_CONFLICT,
            self::RESWEB_PRODUCTBOOKING_TOTAL_PRICE_CONFLICT,
            self::RESWEB_PRODUCTBOOKING_UP_AND_TP_MISSMATCH,
            self::RESWEB_PRODUCTBOOKING_TOTAL_PRICE_MISMATCH,
            self::RESWEB_HOTELBOOKING_PRICE_INCREASED,
            self::RESWEB_HOTELBOOKING_PRICE_DECREASED,
        );
        $reswebCodes = self::extractReswebCodes($errors);
        $intersection = array_intersect($priceErrors, $reswebCodes);

        $priceIssue = false;
        if (count($intersection)) {
            $priceIssue = true;
        }

        return ($priceIssue);
    }

    /**
     * Detects if the error is caused by a traveler mismatch problem
     *
     * @param array $errors error list from resweb response
     *
     * @return bool
     *
     * @static
     */
    public static function travelerMismatch(array $errors)
    {
        $travelerErrors = array(
            self::RESWEB_CART_HOTEL_TRAVELERS_NUMBER_MISMATCH
        );
        $reswebCodes = self::extractReswebCodes($errors);
        $intersection = array_intersect($travelerErrors, $reswebCodes);

        $travelerIssue = false;
        if (count($intersection)) {
            $travelerIssue = true;
        }

        return ($travelerIssue);
    }

    /**
     * Detects if the error is caused by a room not available problem
     *
     * @param array $errors error list from resweb response
     *
     * @return bool
     *
     * @static
     */
    public static function roomNotAvailable(array $errors)
    {
        $errorExists = false;
        $reswebCodes = self::extractReswebCodes($errors);

        if (in_array(self::RESWEB_HOTELBOOKING_ROOM_NOT_AVAILABLE, $reswebCodes)) {
            $errorExists = true;
        }

        return ($errorExists);
    }

    /**
     * detects if there's a voucher invalid error in the resweb error array
     * this could happen when a already validated voucher became invalid as for example of parallel booking using same voucher
     *
     * @param array $errors error list from resweb response
     *
     * @return bool
     *
     * @static
     */
    public static function voucherInvalid(array $errors)
    {
        $invalid = false;
        $reswebCodes = self::extractReswebCodes($errors);

        if (in_array(self::RESWEB_PAYMENT_INVALID_VOUCHER, $reswebCodes) || in_array(self::RESWEB_VOUCHER_INSUFFICIENT_BALANCE, $reswebCodes)) {
            $invalid = true;
        }

        return ($invalid);
    }

    /**
     * extract the resweb codes from the list
     *
     * @param array $errors error list from resweb response
     *
     * @return array
     *
     * @static
     */
    public static function extractReswebCodes(array $errors)
    {
        $codes = array();
        foreach ($errors as $item) {
            if (isset($item->code)) {
                $codes[] = $item->code;
            }
        }

        return ($codes);
    }

    /**
     * Exclude some ResWeb errors from being logged as app.ERROR
     *
     * @param array $errors error list from resweb response (from ExceptionListener.php)
     *
     * @return bool
     *
     * @static
     */
    public static function excludeFromLogger(array $errors)
    {
        //ResWeb errors that could not be considered as application errors
        $notAppErrors = array(
            self::RESWEB_JOURNEYFORCHECKIN_PERIOD_LARGER,
            self::RESWEB_BEGIN_CHECKIN_RESERVATION_NOT_FOUND,
            self::RESWEB_JOURNEYFORCHECKIN_PERIOD_LARGER,
            self::RESWEB_JOURNEYFORCHECKIN_NO_ITINERARY,
            self::RESWEB_JOURNEYFORCHECKIN_CHILD_VALIDATION,
            self::RESWEB_JOURNEYFORCHECKIN_PERIOD_SMALLER,
            self::RESWEB_BEGIN_CHECKIN_RESERVATION_CANCELED,
        );
        $disableLog = false;
        foreach ($errors as $error) {
            //for OLCI we have arrays but for booking path is stdClass Object
            $error = json_decode(json_encode($error), true);
            if (isset($error['reswebCode']) && in_array($error['reswebCode'], $notAppErrors)) {
                $disableLog = true;
            }
        }

        return $disableLog;
    }

}
